<?php
/*
Template Name: Plantilla Usuarios
 */

do_action('create_table_user');
wp_head();
do_action('get_list_users');

?>
<form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="formCreateUser">

    <label for="name">Nombre</label>
    <input type="text" id="name" name="name" placeholder="Nombre" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Email" required>

    <label for="pass">Contraseña</label>
    <input type="password" id="pass" name="pass" placeholder="Contraseña" required>

    <button type="submit">Guardar Usuario</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    if (isset($_POST['delete_user'])) {
        $user_id = intval($_POST['user_id']);
        deleteOneUser($user_id);         
    }    
}
?>