<?php
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
class thnxblockpaymenticon extends Module implements WidgetInterface
{
	public $PI_fields_name;
	public $hooks_url = '/hooks/hooks.php';
	public $tabs_files_url = '/tabs/tabs.php';
	public $mysql_files_url = '/mysqlquery/mysqlquery.php';
	public $data_url = '/data/data.php';
	public $icon_url = '/icon/icon.php';
    public $css_files = array(
    	array(
    		'key' => 'thnxblockpaymenticon_css',
    		'src' => 'thnxblockpaymenticon.css',
    		'priority' => 50,
    		'media' => 'all',
    		'load_theme' => false,
    	)
    );
	public $js_files = array(
		array(
			'key' => 'thnxblockpaymenticon_js',
			'src' => 'thnxblockpaymenticon.js',
			'priority' => 50,
			'position' => 'bottom', // bottom or head
			'load_theme' => false,
		)
	);
	public function __construct()
	{
		$this->name = 'thnxblockpaymenticon';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'thanksit.com';
		$this->bootstrap = true;
		$this->PI_fields_name = array(
				'thnx_PAYPAL_URL',
				'thnx_VISA_URL',
				'thnx_DISCOVER_URL',
				'thnx_MASTERCART_URL',
				'thnx_AMERICANEXPRESS_URL',
				'thnx_MAESTRO_URL',
				'thnx_VISAELECTRON_URL',
				'thnx_CIRRUS_URL',
				'thnxblockpayment_column',
				'thnxblockpayment_float');
		parent::__construct();
		$this->displayName = $this->l('Platinum Theme Payment Icon');
		$this->description = $this->l('Platinum Theme Payment Icon Show in your Shop');
		$this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
	}
	public function install()
	{
		if(!parent::install()
		 || !$this->Register_SQL()
		 || !$this->Register_Config()
		 || !$this->Register_Hooks()
		 || !$this->xpertsampledata()
		)
			return false;
		return true;
	}
	public function uninstall()
	{
		if(!parent::uninstall()
		 || !$this->UnRegister_Hooks()
		 || !$this->UnRegister_Config()
		 || !$this->UnRegister_SQL()
		)
			return false;
		return true;
	}
	public function xpertsampledata($demo=NULL)
	{
		if(($demo==NULL) || (empty($demo)))
			$demo = "demo_1";
		$func = 'xpertsample_'.$demo;
		if(method_exists($this,$func)){
        	$this->{$func}();
        }
        return true;
	}
	public function xpertsample_demo_1()
	{
		Configuration::updateValue("thnx_PAYPAL_URL","http://www.paypal.com");
		Configuration::updateValue("thnx_VISA_URL","http://www.visa.com");
		Configuration::updateValue("thnx_DISCOVER_URL","http://www.discover.com");
		Configuration::updateValue("thnx_MASTERCART_URL","http://www.mastercard.com");
		Configuration::updateValue("thnxblockpayment_column","4");
		Configuration::updateValue("thnxblockpayment_float","disable");
		return true;
	}
	public function xpertsample_demo_2()
	{
		Configuration::updateValue("thnx_PAYPAL_URL","http://www.paypal.com");
		Configuration::updateValue("thnx_VISA_URL","http://www.visa.com");
		Configuration::updateValue("thnx_DISCOVER_URL","http://www.discover.com");
		Configuration::updateValue("thnx_MASTERCART_URL","http://www.mastercard.com");
		Configuration::updateValue("thnxblockpayment_column","6");
		Configuration::updateValue("thnxblockpayment_float","f_right");
		return true;
	}
	public function xpertsample_demo_3()
	{
		Configuration::updateValue("thnx_PAYPAL_URL","http://www.paypal.com");
		Configuration::updateValue("thnx_VISA_URL","http://www.visa.com");
		Configuration::updateValue("thnx_DISCOVER_URL","http://www.discover.com");
		Configuration::updateValue("thnx_MASTERCART_URL","http://www.mastercard.com");
		Configuration::updateValue("thnxblockpayment_column","6");
		Configuration::updateValue("thnxblockpayment_float","f_right");
		return true;
	}
	public function xpertsample_demo_4()
	{
		Configuration::updateValue("thnx_PAYPAL_URL","http://www.paypal.com");
		Configuration::updateValue("thnx_VISA_URL","http://www.visa.com");
		Configuration::updateValue("thnx_DISCOVER_URL","http://www.discover.com");
		Configuration::updateValue("thnx_MASTERCART_URL","http://www.mastercard.com");
		Configuration::updateValue("thnxblockpayment_column","");
		Configuration::updateValue("thnxblockpayment_float","");
		return true;
	}
	public function xpertsample_demo_5()
	{
		Configuration::updateValue("thnx_PAYPAL_URL","http://www.paypal.com");
		Configuration::updateValue("thnx_VISA_URL","http://www.visa.com");
		Configuration::updateValue("thnx_DISCOVER_URL","http://www.discover.com");
		Configuration::updateValue("thnx_MASTERCART_URL","http://www.mastercard.com");
		Configuration::updateValue("thnxblockpayment_column","6");
		Configuration::updateValue("thnxblockpayment_float","f_right");
		return true;
	}
	public function xpertsample_demo_6()
	{
		Configuration::updateValue("thnx_PAYPAL_URL","http://www.paypal.com");
		Configuration::updateValue("thnx_VISA_URL","http://www.visa.com");
		Configuration::updateValue("thnx_DISCOVER_URL","http://www.discover.com");
		Configuration::updateValue("thnx_MASTERCART_URL","http://www.mastercard.com");
		Configuration::updateValue("thnxblockpayment_column","");
		Configuration::updateValue("thnxblockpayment_float","");
		return true;
	}
	public function xpertsample_demo_7()
	{
		Configuration::updateValue("thnx_PAYPAL_URL","http://www.paypal.com");
		Configuration::updateValue("thnx_VISA_URL","http://www.visa.com");
		Configuration::updateValue("thnx_DISCOVER_URL","http://www.discover.com");
		Configuration::updateValue("thnx_MASTERCART_URL","http://www.mastercard.com");
		Configuration::updateValue("thnxblockpayment_column","none");
		Configuration::updateValue("thnxblockpayment_float","disable");
		return true;
	}
	public function Register_Config()
	{
			$data = array();
	        require_once(dirname(__FILE__).$this->data_url);
        if(isset($data) && !empty($data))
        	foreach($data as $data_key => $data_val):
        		Configuration::updateValue($data_key,$data_val);
        	endforeach;
        	return true;
        return false;
	}
	public function UnRegister_Config()
	{
			$data = array();
	        require_once(dirname(__FILE__).$this->data_url);
        if(isset($data) && !empty($data))
        	foreach($data as $data_key => $data_val):
        		Configuration::deleteByName($data_key);
        	endforeach;
        	return true;
        return false;
	}
	public function Register_Hooks()
	{
		$hooks = array();
        require_once(dirname(__FILE__).$this->hooks_url);
        if(isset($hooks) && !empty($hooks))
        	foreach($hooks as $hook):
        		$this->registerHook($hook);
        	endforeach;
        	return true;
        return false;
	}
	public function UnRegister_Hooks()
	{
		$hooks = array();
        require_once(dirname(__FILE__).$this->hooks_url);
        if(isset($hooks) && !empty($hooks))
        	foreach($hooks as $hook):
	        		$hook_id = Hook::getIdByName($hook);
	        	if(isset($hook_id) && !empty($hook_id))
	        		$this->unregisterHook((int)$hook_id);
        	endforeach;
        	return true;
        return false;
	}
    public static function isEmptyFileContet($path = null){
    	if($path == null)
    		return false;
    	if(file_exists($path)){
    		$content = Tools::file_get_contents($path);
    		if(empty($content)){
    			return false;
    		}else{
    			return true;
    		}
    	}else{
    		return false;
    	}
    }
    public function Register_Css()
    {
        if(isset($this->css_files) && !empty($this->css_files)){
        	$theme_name = $this->context->shop->theme_name;
    		$page_name = $this->context->controller->php_self;
    		$root_path = _PS_ROOT_DIR_.'/';
        	foreach($this->css_files as $css_file):
        		if(isset($css_file['key']) && !empty($css_file['key']) && isset($css_file['src']) && !empty($css_file['src'])){
        			$media = (isset($css_file['media']) && !empty($css_file['media'])) ? $css_file['media'] : 'all';
        			$priority = (isset($css_file['priority']) && !empty($css_file['priority'])) ? $css_file['priority'] : 50;
        			$page = (isset($css_file['page']) && !empty($css_file['page'])) ? $css_file['page'] : array('all');
        			if(is_array($page)){
        				$pages = $page;
        			}else{
        				$pages = array($page);
        			}
        			if(in_array($page_name, $pages) || in_array('all', $pages)){
        				if(isset($css_file['load_theme']) && ($css_file['load_theme'] == true)){
        					$theme_file_src = 'themes/'.$theme_name.'/assets/css/'.$css_file['src'];
        					if(self::isEmptyFileContet($root_path.$theme_file_src)){
        						$this->context->controller->registerStylesheet($css_file['key'], $theme_file_src , ['media' => $media, 'priority' => $priority]);
        					}
        				}else{
        					$module_file_src = 'modules/'.$this->name.'/css/'.$css_file['src'];
        					if(self::isEmptyFileContet($root_path.$module_file_src)){
        						$this->context->controller->registerStylesheet($css_file['key'], $module_file_src , ['media' => $media, 'priority' => $priority]);
        					}
        				}
    				}
        		}
        	endforeach;
        }
        return true;
    }
    public function Register_Js()
    {
        if(isset($this->js_files) && !empty($this->js_files)){
	    	$theme_name = $this->context->shop->theme_name;
			$page_name = $this->context->controller->php_self;
			$root_path = _PS_ROOT_DIR_.'/';
        	foreach($this->js_files as $js_file):
        		if(isset($js_file['key']) && !empty($js_file['key']) && isset($js_file['src']) && !empty($js_file['src'])){
        			$position = (isset($js_file['position']) && !empty($js_file['position'])) ? $js_file['position'] : 'bottom';
        			$priority = (isset($js_file['priority']) && !empty($js_file['priority'])) ? $js_file['priority'] : 50;
        			$page = (isset($css_file['page']) && !empty($css_file['page'])) ? $css_file['page'] : array('all');
        			if(is_array($page)){
        				$pages = $page;
        			}else{
        				$pages = array($page);
        			}
        			if(in_array($page_name, $pages) || in_array('all', $pages)){
	        			if(isset($js_file['load_theme']) && ($js_file['load_theme'] == true)){
	        				$theme_file_src = 'themes/'.$theme_name.'/assets/js/'.$js_file['src'];
	        				if(self::isEmptyFileContet($root_path.$theme_file_src)){
	        					$this->context->controller->registerJavascript($js_file['key'], $theme_file_src , ['position' => $position, 'priority' => $priority]);
	        				}
	        			}else{
		        			$module_file_src = 'modules/'.$this->name.'/js/'.$js_file['src'];
	        				if(self::isEmptyFileContet($root_path.$module_file_src)){
		        				$this->context->controller->registerJavascript($js_file['key'], $module_file_src , ['position' => $position, 'priority' => $priority]);
	        				}
	        			}
        			}
        		}
        	endforeach;
        }
        return true;
    }
	public function Register_SQL()
	{
		$mysqlquery = array();
			require_once(dirname(__FILE__).$this->mysql_files_url);
			if(isset($mysqlquery) && !empty($mysqlquery))
				foreach($mysqlquery as $query){
					if(!Db::getInstance()->Execute($query))
					    return false;
				}
        return true;
	}
	public function UnRegister_SQL()
	{
		$mysqlquery_u = array();
			require_once(dirname(__FILE__).$this->mysql_files_url);
			if(isset($mysqlquery_u) && !empty($mysqlquery_u))
				foreach($mysqlquery_u as $query_u){
					if(!Db::getInstance()->Execute($query_u))
					    return false;
				}
        return true;
	}
	public function getContent()
	{
		if(Tools::isSubmit('submit'.$this->name))
		{
			$arr_val = array();
			if(isset($this->PI_fields_name) && !empty($this->PI_fields_name)){
				foreach($this->PI_fields_name as $PI_fields_name)
				{
					Configuration::updateValue($PI_fields_name, Tools::getValue($PI_fields_name));
				}	
			}
		}
		return $this->renderForm();
	}
	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Platinum Theme Payment Icon Settings'),
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('PayPal URL'),
						'name' => 'thnx_PAYPAL_URL',
						'desc' => $this->l('Enter PayPal URL.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('VISA URL'),
						'name' =>  'thnx_VISA_URL',
						'desc' => $this->l('Enter VISA URL.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('DISCOVER URL'),
						'name' =>  'thnx_DISCOVER_URL',
						'desc' => $this->l('Enter DISCOVER URL.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('MASTERCART URL'),
						'name' =>  'thnx_MASTERCART_URL',
						'desc' => $this->l('Enter MASTERCART URL.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('AMERICAN EXPRESS URL'),
						'name' =>  'thnx_AMERICANEXPRESS_URL',
						'desc' => $this->l('Enter AMERICAN EXPRESS URL.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('MAESTRO URL'),
						'name' =>  'thnx_MAESTRO_URL',
						'desc' => $this->l('Enter MAESTRO URL.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('VISAELECTRON URL'),
						'name' =>  'thnx_VISAELECTRON_URL',
						'desc' => $this->l('Enter VISAELECTRON URL.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('CIRRUS URL'),
						'name' =>  'thnx_CIRRUS_URL',
						'desc' => $this->l('Enter CIRRUS URL.'),
					),
					array(
					    'type' => 'select',
					    'label' => $this->l('Select column'),
					    'name' => 'thnxblockpayment_column',
					    'default_val' => '4',
					    'desc' => $this->l('Choose colum for this block'),
					    'options' => array(
					    	'id' => 'id',
					    	'name' => 'name',
					    	'query' => array(
					    		array(
					    			'id' => '6',
					    			'name' => 'Column two (col-sm-6)'
					    			),
					    		array(
					    			'id' => '4',
					    			'name' => 'Column three (col-sm-4)'
					    			),
					    		array(
					    			'id' => '3',
					    			'name' => 'Column four (col-sm-3)'
					    			),
					    		array(
					    			'id' => '12',
					    			'name' => 'Column full (col-sm-12)'
					    			),
					    		array(
					    			'id' => 'none',
					    			'name' => 'None'
					    			),
					    		)
					    	)
					),
					array(
					    'type' => 'select',
					    'label' => $this->l('Float Align'),
					    'name' => 'thnxblockpayment_float',
					    'default_val' => 'disable',
					    'desc' => $this->l('Choose colum for this block'),
					    'options' => array(
					    	'id' => 'id',
					    	'name' => 'name',
					    	'query' => array(
					    		array(
					    			'id' => 'disable',
					    			'name' => 'Float Disable'
					    			),
					    		array(
					    			'id' => 'f_left',
					    			'name' => 'Float Left'
					    			),
					    		array(
					    			'id' => 'f_right',
					    			'name' => 'Float Right'
					    			),
					    		array(
					    			'id' => 'f_none',
					    			'name' => 'Float none'
					    			),
					    		)
					    	)
					),
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table =  $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submit'.$this->name;
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);
		return $helper->generateForm(array($fields_form));
	}
	public function getConfigFieldsValues()
	{
		$arr_val = array();
		if(isset($this->PI_fields_name) && !empty($this->PI_fields_name)){
			foreach($this->PI_fields_name as $PI_fields_name){
				$arr_val[$PI_fields_name] = Tools::getValue($PI_fields_name, Configuration::get($PI_fields_name));
			}
		}
		return $arr_val;
	}
	public function renderWidget($hookName = null, array $configuration = [])
	{
	    $this->smarty->assign($this->getWidgetVariables($hookName,$configuration));
	    return $this->fetch('module:'.$this->name.'/views/templates/front/'.$this->name.'.tpl');	
	}
	public function getWidgetVariables($hookName = null, array $configuration = [])
	{
	    $arr_val = array();
	    if(isset($this->PI_fields_name) && !empty($this->PI_fields_name)){
	    	foreach($this->PI_fields_name as $PI_fields_name)
	    	{
	    		$arr_val[$PI_fields_name] = Configuration::get($PI_fields_name);
	    	}
	    }
	    $arr_val['pi_path'] = $this->_path.'img/';
	    $arr_val['hookName'] = $hookName;
	    return $arr_val;
	}
	public function hookDisplayHeader($params)
	{
		$this->Register_Css();
		$this->Register_Js();
	}
}