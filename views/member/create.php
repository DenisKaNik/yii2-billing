<?php

/* @var $this yii\web\View */
/* @var $model billing\forms\MemberForm */

?>
<div class="modal fade" id="modalCreateMember" tabindex="-1" role="dialog" aria-labelledby="modalCreateMemberLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalCreateMemberLabel">Create Member</h4>
            </div>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
