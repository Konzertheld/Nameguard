<?php
/*
 * Nameguard Plugin
 */
 
class Nameguard extends Plugin
{
	/**
	 * Hook to the comment form to add a validator to the commenter name
	 */
	 function action_form_comment($form)
	 {
		$form->cf_commenter->add_validator(array($this, 'validate_commenter'));
	 }
	 
	 function validate_commenter($commenter, $control, $form)
	 {
		$users = Users::get(array('username' => $commenter));
		if(!count($users))
		{
			$users = Users::get_by_info('displayname', $commenter);
			if(!count($users))
			{
				return array();
			}
		}
		return array(_t('This name is already in use!', __CLASS__));
	 }
}
?>