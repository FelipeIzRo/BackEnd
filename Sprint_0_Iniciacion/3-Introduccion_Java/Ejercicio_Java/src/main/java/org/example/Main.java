package org.example;

import java.io.*;
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        String opcion = "";
        Scanner sc = new Scanner (System.in);

        System.out.println("1-Añadir nombres\n2-Mostrar nombres\n3-Salir");

        while(!(opcion = sc.nextLine()).equals("3")){

            switch(opcion){
                case "1":{
                    AniadirNombres();
                    break;
                }
                case "2":{
                    MostraNombres();
                    break;
                }
                default:{
                    System.out.println("opcion elegida no valida");
                    break;
                }
            }
            System.out.println("1-Añadir nombres\n2-Mostrar nombres\n3-Salir");
        }
        System.out.println("Fin del programa");
    }

    public static void AniadirNombres(){
        System.out.println("Introducir los alumnos separados por comas");
        Scanner sc = new Scanner (System.in);
        String alumnos[] = sc.nextLine().split(",");
        try {
            BufferedWriter writer = new BufferedWriter(new FileWriter("alumnos.txt"));

            for(int i = 0;i < alumnos.length;i++){
                writer.write(alumnos[i].trim()+"\n");
            }
            writer.close();
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }

    public static void MostraNombres(){
        try {
            BufferedReader reader = new BufferedReader(new FileReader("alumnos.txt"));
            String alumno;
            while((alumno = reader.readLine())!=null){
                System.out.println(alumno);
            }
            reader.close();
        } catch (FileNotFoundException e) {
            throw new RuntimeException(e);
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }
}