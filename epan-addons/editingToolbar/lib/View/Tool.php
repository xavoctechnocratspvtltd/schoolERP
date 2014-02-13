<?php

namespace editingToolbar;
/**
 * This is tool class for all all tools
 */
class View_Tool extends \View {
	/**
	 * $namespace it contain the namespace of child class 
	 * @var String
	 */
	public $namespace=null;
	/**
	 * $title It is name of Tool 
	 * @var string
	 */
	public $title='Tool';
	/**
	 * $class Which component to be rendered as on Drop by this Tool
	 * @var String
	 */
	public $class = null; // Which component to be rendered as on Drop by this Tool
	/**
	 * $icon_file Image/ Icon file of Tool, Only png type file.
	 * @var String
	 */
	public $icon_file=null;
	/**
	 * $drag_html It contain complete HTML which about to drag on page
	 * if defined in Inherited class then it will be dropped, otherwise class html will be dropped.
	 * @var String
	 */
	public $drag_html=null;

	function init(){
		parent::init();

		if($this->class == null)
			throw $this->exception('Please define a public variable \'class\' containing Class name of Component to be created by dropping ')
						->addMoreInfo('for',$this->title);

		$this_class = get_class($this);
		$namespace_class =explode("\\", $this_class);
		$this->namespace = $namespace_class[0];

	}

	function defaultTemplate(){
		$l=$this->api->locate('addons',__NAMESPACE__, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',__NAMESPACE__),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);
		return array('view/editingToolbar-tool');
	}

	function recursiveRender(){
		$this->template->set('namespace',$this->namespace);
		$this->template->set('title',$this->title);
		$this->template->set('class',$this->class);
		if($this->icon_file == null){
			$this->icon_file= strtolower(str_replace(" ", "", $this->title))."_icon";
			$this->template->trySet('icon',$this->icon_file);
		}


		// What to drop by Tool
		if($this->drag_html == null ){
			// No Drag HTML defined by tool, lets try to make here
			$drag_html = $this->add($this->namespace.'/'.$this->class);
			
			if($drag_html->is_sortable)
				$this->template->trySet('create_sortable','true');
			else
				$this->template->trySet('create_sortable','false');

			if($drag_html->items_allowed !== null)
				$this->template->trySet('items_allowed',$drag_html->items_allowed);

			if($drag_html->items_cancelled !== null)
				$this->template->trySet('items_cancelled',$drag_html->items_cancelled);

			$drag_html->template->append('attributes','component_namespace="'.$this->namespace .'"');
			$drag_html->template->append('attributes','component_type="'.$drag_html->component_type.'"');


			$this->drag_html = $drag_html->getHTML();
		}
		$this->template->trySetHTML('drag_html',$x=str_replace("'", '"', trim(preg_replace('#\R+#', ' ', $this->drag_html))));


		// OPTIONS  to be shown on Quick Component options
		if(file_exists(getcwd().'/epan-components/'.$this->namespace.'/templates/view/'.$this->namespace.'-'.strtolower($drag_html->component_type).'-options.html')){
			$options = $this->add('componentBase/View_Options',array('namespace'=>$this->namespace,'component_type'=>$drag_html->component_type),'options');
		}
		
		$drag_html->destroy();

		parent::recursiveRender();
	}

}