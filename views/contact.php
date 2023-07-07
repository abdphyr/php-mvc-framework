<?php $this->title = 'Contact' ?>
<div class="mt-5">
  <h3 class="text-center">
    Send message
  </h3>
  <?php $form = Abd\Mvc\View\Form::begin('', "post") ?>
  <?php echo $form->field($errors, $model, 'subject') ?>
  <?php echo $form->field($errors, $model, 'email')->email() ?>
  <?php echo $form->field($errors, $model, 'body')->textarea() ?>  
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php Abd\Mvc\View\Form::end() ?>
</div>