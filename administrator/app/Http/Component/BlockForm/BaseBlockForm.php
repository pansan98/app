<?php

namespace App\Http\Component\BlockForm;

abstract class BaseBlockForm {
    
    protected $id;
    protected $type;
    
    public $template;
    public $templateDirectory;
    public $formTemplate = null;
    public $contentTemplate = null;
    public $name;
    public $formName = '';
    public $constraints = [];
    public $enableRequired = false;
    public $values = [];
    public $errors = [];
    public $options = [];
    public $formDisplayLayout = 'content';
    public $blockClass = null;
    
    public $defaultOptions;
    
    
    public function __construct($name, $options = [])
    {
        $this->name = $name;
        
        $defaultOptions = [
            'template' => $this->template,
            'template_directory' => $this->templateDirectory,
            'form_template' => $this->formTemplate,
            'content_template' => $this->contentTemplate,
            'form_name' => $this->formName,
            'constraints' => $this->constraints,
            'enable_required' => $this->enableRequired,
            'values' => $this->values,
            'errors' => $this->errors,
            'options' => $this->options,
            'form_display_layout' => $this->formDisplayLayout,
            'block_class' => $this->blockClass
        ];
        
        $defaultOptions = $this->filterDefaultOptions($defaultOptions);
        
        $options = array_merge($defaultOptions, $options);
        
        $this->formInit($options);
        
        $this->defaultOptions = $options;
    }
    
    public function formInit($options)
    {
        $this->setTemplate($options['template']);
        $this->setTemplateDirectory($options['template_directory']);
        $this->setFormTemplate($options['form_template']);
        $this->setContentTemplate($options['content_template']);
        $this->setFormName($options['form_name']);
        $this->setConstraints($options['constraints']);
        $this->setValues($options['values']);
        $this->setErrors($options['errors']);
        $this->setOptions($options['options']);
        $this->setFormDisplayLayout($options['form_display_layout']);
        $this->setBlockClass($options['block_class']);
        
        if($options['enable_required']) {
            $this->enableActive();
        }
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    
    public function getTemplate()
    {
        return $this->template;
    }
    
    public function setTemplateDirectory($templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
        return $this;
    }
    
    public function getTemplateDirectory()
    {
        return $this->templateDirectory;
    }
    
    public function setFormTemplate($formTemplate)
    {
        $this->formTemplate = $formTemplate;
        return $this;
    }
    
    public function getFormTemplate()
    {
        return $this->formTemplate;
    }
    
    public function setContentTemplate($contentTemplate)
    {
        $this->contentTemplate = $contentTemplate;
        return $this;
    }
    
    public function getContentTemplate()
    {
        return $this->contentTemplate;
    }
    
    public function setFormName($formName)
    {
        $this->formName = $formName;
        return $this;
    }
    
    public function getFormName()
    {
        return $this->formName;
    }
    
    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;
        return $this;
    }
    
    public function getConstraints()
    {
        return $this->constraints;
    }
    
    public function enableActive()
    {
        $this->enableRequired = true;
        return $this;
    }
    
    public function getEnableRequired()
    {
        return $this->enableRequired;
    }
    
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }
    
    public function getValues()
    {
        if(!empty($this->values)) {
            return $this->values;
        }
    }
    
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setFormDisplayLayout($formDisplayLayout)
    {
        $this->formDisplayLayout = $formDisplayLayout;
        return $this;
    }
    
    public function getFormDisplayLayout()
    {
        return $this->formDisplayLayout;
    }
    
    public function setBlockClass($blockClass)
    {
        $this->blockClass = $blockClass;
        return $this;
    }
    
    public function getBlockClass()
    {
        return $this->blockClass;
    }
    
    public function getValue($field, $default = null)
    {
        if(isset($this->defaultOptions[$field]) AND !empty($this->defaultOptions[$field])) {
            return $this->defaultOptions[$field];
        }
        
        return $default;
    }
    
    public function getData()
    {
        return $this->values === [] ? null : $this->values;
    }
    
    public function addConstraints($name, $constraint)
    {
        if(!isset($this->constraints[$name])) {
            $this->constraints[$name] = [];
        }
        
        if(!in_array($this->constraints[$name], $constraint)) {
            $this->constraints[$name][] = $constraint;
        }
    }
    
    public function filterDefaultOptions($options)
    {
        return $options;
    }
}