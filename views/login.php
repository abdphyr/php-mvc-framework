<?php $this->title = 'Login'?>
<div class="mt-5">
  <h3 class="text-center">
    Login
  </h3>
  <?php $form = Abd\Mvc\View\Form::begin('', "post") ?>
  <?php if (session()->getFlash('login')) : ?>
      <div class="alert alert-danger">
        <?php echo session()->getFlash('login') ?>
      </div>
    <?php endif ?>
    
  <?php echo $form->field($errors, $model, 'email')->email() ?>
  <?php echo $form->field($errors, $model, 'password')->password() ?>

  <button type="submit" class="btn btn-primary">Submit</button>
  <?php Abd\Mvc\View\Form::end() ?>
</div>