<div class="container">
    <div class="row">
        <div class="span12">
            <h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

            <p><?php echo lang('reset_password_unsuccessful'); ?></p>

            <p><?php echo anchor('auth/account/forgot_password', lang('reset_password_resend'), array('class' => 'btn')); ?></p>
        </div>
    </div>
</div>
