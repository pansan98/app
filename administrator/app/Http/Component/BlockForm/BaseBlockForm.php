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
    
    /**
     * ブロックの初期設定
     *
     * BaseBlockForm constructor.
     * @param $name
     * @param array $options
     */
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
    
    /**
     * ブロックオプションの設定
     *
     * @param $options
     */
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
    
    /**
     * ブロック名を取得
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * テンプレートファイルの設定
     *
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    
    /**
     * テンプレートファイルの取得
     *
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    /**
     * テンプレートファイルまでのディレクトリの設定
     *
     * @param $templateDirectory
     * @return $this
     */
    public function setTemplateDirectory($templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
        return $this;
    }
    
    /**
     * テンプレートファイルまでのディレクトリを取得する
     *
     * @return mixed
     */
    public function getTemplateDirectory()
    {
        return $this->templateDirectory;
    }
    
    /**
     * フォームのテンプレートファイルの設定
     *
     * @param $formTemplate
     * @return $this
     */
    public function setFormTemplate($formTemplate)
    {
        $this->formTemplate = $formTemplate;
        return $this;
    }
    
    /**
     * フォームのテンプレートファイルを取得
     *
     * @return null
     */
    public function getFormTemplate()
    {
        return $this->formTemplate;
    }
    
    /**
     * フロントのテンプレートファイルの設定
     *
     * @param $contentTemplate
     * @return $this
     */
    public function setContentTemplate($contentTemplate)
    {
        $this->contentTemplate = $contentTemplate;
        return $this;
    }
    
    /**
     * フロントのテンプレートファイルを取得
     *
     * @return null
     */
    public function getContentTemplate()
    {
        return $this->contentTemplate;
    }
    
    /**
     * フォーム名の設定
     *
     * @param $formName
     * @return $this
     */
    public function setFormName($formName)
    {
        $this->formName = $formName;
        return $this;
    }
    
    /**
     * フォーム名を取得
     *
     * @return string
     */
    public function getFormName()
    {
        return $this->formName;
    }
    
    /**
     * バリデーションの設定
     *
     * @param $constraints
     * @return $this
     */
    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;
        return $this;
    }
    
    /**
     * バリデーションの取得
     *
     * @return array
     */
    public function getConstraints()
    {
        return $this->constraints;
    }
    
    /**
     * 必須の有効化
     *
     * @return $this
     */
    public function enableActive()
    {
        $this->enableRequired = true;
        return $this;
    }
    
    /**
     * 必須の有効化を取得
     *
     * @return bool
     */
    public function getEnableRequired()
    {
        return $this->enableRequired;
    }
    
    /**
     * 値の設定
     *
     * @param $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }
    
    /**
     * 値の取得
     *
     * @return array
     */
    public function getValues()
    {
        if(!empty($this->values)) {
            return $this->values;
        }
        
        return null;
    }
    
    /**
     * エラーの設定
     *
     * @param $errors
     * @return $this
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }
    
    /**
     * エラーの取得
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * オプション設定
     *
     * @param $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
    
    /**
     * オプションを取得
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * フォームのレイアウト位置の設定
     *
     * @param $formDisplayLayout
     * @return $this
     */
    public function setFormDisplayLayout($formDisplayLayout)
    {
        $this->formDisplayLayout = $formDisplayLayout;
        return $this;
    }
    
    /**
     * フォームのレイアウト位置の取得
     *
     * @return string
     */
    public function getFormDisplayLayout()
    {
        return $this->formDisplayLayout;
    }
    
    /**
     * ブロッククラスの設定
     *
     * @param $blockClass
     * @return $this
     */
    public function setBlockClass($blockClass)
    {
        $this->blockClass = $blockClass;
        return $this;
    }
    
    /**
     * ブロッククラスの取得
     *
     * @return null
     */
    public function getBlockClass()
    {
        return $this->blockClass;
    }
    
    /**
     * 値の取得
     *
     * @param $field
     * @param null $default
     * @return null
     */
    public function getValue($field, $default = null)
    {
        if(isset($this->defaultOptions[$field]) AND !empty($this->defaultOptions[$field])) {
            return $this->defaultOptions[$field];
        }
        
        return $default;
    }
    
    /**
     * データの取得
     *
     * @return array|null
     */
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
    
    /**
     * 個別のオプションを付与｜継承先で利用する
     *
     * @param $options
     * @return mixed
     */
    public function filterDefaultOptions($options)
    {
        return $options;
    }
}