<?php if (!defined('IN_PHPBB')) exit; $this->_tpldata['DEFINE']['.']['CA_SKIP_PM_NOTIFY'] = '1'; $this->_tpl_include('overall_header.html'); ?>


<div class="panel" id="message">
	<?php echo (isset($this->_tpldata['DEFINE']['.']['CA_BLOCK_START'])) ? $this->_tpldata['DEFINE']['.']['CA_BLOCK_START'] : ''; ?>

	<h2><?php echo (isset($this->_rootref['MESSAGE_TITLE'])) ? $this->_rootref['MESSAGE_TITLE'] : ''; ?></h2>
	<p><?php echo (isset($this->_rootref['MESSAGE_TEXT'])) ? $this->_rootref['MESSAGE_TEXT'] : ''; ?></p>
	<?php if ($this->_rootref['SCRIPT_NAME'] == ("search") && ! $this->_rootref['S_BOARD_DISABLED'] && ! $this->_rootref['S_NO_SEARCH'] && $this->_rootref['L_RETURN_TO_SEARCH_ADV']) {  ?><p><a href="<?php echo (isset($this->_rootref['U_SEARCH'])) ? $this->_rootref['U_SEARCH'] : ''; ?>" class="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>"><?php echo ((isset($this->_rootref['L_RETURN_TO_SEARCH_ADV'])) ? $this->_rootref['L_RETURN_TO_SEARCH_ADV'] : ((isset($user->lang['RETURN_TO_SEARCH_ADV'])) ? $user->lang['RETURN_TO_SEARCH_ADV'] : '{ RETURN_TO_SEARCH_ADV }')); ?></a></p><?php } ?>

	<?php echo (isset($this->_tpldata['DEFINE']['.']['CA_BLOCK_END'])) ? $this->_tpldata['DEFINE']['.']['CA_BLOCK_END'] : ''; ?>

</div>

<?php $this->_tpl_include('overall_footer.html'); ?>