<?php

namespace App\Controller;

use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductosController extends AbstractController
{
    private $entityManager;
    private $serializerInterface;

    public function __construct(EntityManagerInterface $entityManager,SerializerInterface $serializerInterface)
    {
        $this->entityManager = $entityManager;
        $this->serializerInterface =$serializerInterface;
    }
    /**
     * @Route("/", name="index")
     */
    public function index(): JsonResponse
    {
        $products = $this->entityManager->getRepository(Productos::class)->findAll();

        $productsArray = [];
        foreach ($products as $product) {
            $productsArray[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'stock' => $product->getStock()
            ];
        }

        return new JsonResponse($productsArray, 200);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request): JsonResponse
    {
        $data = $request->getContent();

        $product = $this->serializerInterface->deserialize($data,Productos::class,'json');

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return new JsonResponse(['message','Producto añadido correctamente'], 200);
    }


    /**
     * @Route("/showOne/{id}", name="showOne")
     */
    public function showOne($id): JsonResponse
    {
        $product = $this->entityManager->getRepository(Productos::class)->find($id);

        if (!$product) {
            return new JsonResponse(['error' => 'Producto no encontrado'],404);
        }
        
        $productSerialized = $this->serializerInterface->serialize($product,'json');

        return new JsonResponse($productSerialized,200);        
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id): JsonResponse
    {
        $product = $this->entityManager->getRepository(Productos::class)->find($id);

        if (!$product) {
            return new JsonResponse(['error' => 'Producto no encontrado'],404);
        }
        
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        
        return new JsonResponse(['message','Producto borrado correctamente'],200);
    }

    /**
     * @Route("/modify/{id}",name="modify")
     */
    public function modify($id,Request $request)
    {
        $data = $request->getContent();
        $dataModify = $this->serializerInterface->deserialize($data,Productos::class,'json');

        $product = $this->entityManager->getRepository(Productos::class)->find($id);

        if(!$product)
        {
            return new JsonResponse(['error','Producto no encontrado'],404);
        }
        
        if($dataModify->getName())
        {
            $product->setName($dataModify->getName());
        }
        if($dataModify->getDescription())
        {
            $product->setDescription($dataModify->getDescription());
        }
        if($dataModify->getPrice())
        {
            $product->setPrice($dataModify->getPrice());
        }
        if($dataModify->getStock())
        {
            $product->setStock($dataModify->getStock());
        }

        $this->entityManager->flush();
        
        return new JsonResponse(['status' => 'Producto modificado'], JsonResponse::HTTP_OK);
    }
}
