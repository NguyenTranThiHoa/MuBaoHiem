<?php
if(isset($_SESSION['tinnhan']))
{
    ?>
        <div class="alert alert-warning alert-dismissible fabe show" role="alert">
            <strong> Hey!<strong> <?= $_SESSION['tinnhan'];?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['tinnhan']);
}
?>