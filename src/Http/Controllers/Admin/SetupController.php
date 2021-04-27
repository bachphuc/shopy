<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\Order;
use bachphuc\LaravelHTMLElements\Components\Table;
use bachphuc\LaravelHTMLElements\Components\ViewGroup;
use bachphuc\LaravelHTMLElements\Components\Form;
use bachphuc\LaravelHTMLElements\Components\FormSteps;
use AppSetting;

use App\User;

class SetupController extends Controller
{

    public function createSetupForm(){
        $form = new FormSteps();
        $form->setTheme($this->theme)
        ->setAttributes([
            'show_submit_button' => false,
            'action' => Shopy::adminRoute('setup.store'),
            'has_file' => true,
            'steps' => [
                'id:information;title:Information' => [
                    'name' => [
                        'validator' => 'required'
                    ],
                    'logo' => [
                        'type' => 'image_input'
                    ],
                    'contact_email' => [
                        'validator' => 'required'
                    ],
                    'contact_phone' => [
                        'validator' => 'required'
                    ],
                    'province' => [
                        'validator' => 'required'
                    ],
                    'district' => [
                        'validator' => 'required'
                    ],
                    'ward' => [
                        'validator' => 'required'
                    ],
                    'address' => [
                        'validator' => 'required'
                    ],
                    [
                        'type' => 'button',
                        'title' => 'Next',
                        'class' => 'btn-primary btn-next-tab',
                    ]
                ], 
                'id:category;title:Category' => [
                    'category' => [
                        'type' => 'select',
                        'value' => 'fashion',
                        'validator' => 'required',
                        'options' => [
                            'data' => [
                                [
                                    'title' => 'Fashion',
                                    'value' => 'fashion'
                                ],
                                [
                                    'title' => 'Cellphone',
                                    'value' => 'cellphone'
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'button',
                        'class' => 'btn-primary btn-next-tab',
                        'title' => 'Next',
                    ]
                ],
                'id:theme;title:Theme' => [
                    'theme' => [
                        'type' => 'select',
                        'value' => 'default',
                        'validator' => 'required',
                        'options' => [
                            'data' => [
                                [
                                    'title' => 'Default',
                                    'value' => 'default' 
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'button',
                        'title' => 'Next',
                        'class' => 'btn-primary btn-next-tab',
                    ]
                ],
                'id:sample;title:Sample Data' => [
                    'create_sample_data' => [
                        'title' => 'Do you want to create sample data for your shop?',
                        'type' => 'checkbox',
                        'label' => 'yes',
                        'value' => 1
                    ],
                    'button->title:Submit;button_type:submit;class:btn-success'
                ]
            ]
        ]);

        return $form;
    }

    public function index(Request $request){
        Shopy::setAdminLayout('blank');

        $form = $this->createSetupForm();

        $formStep = new ViewGroup();
        $formStep->setTheme($this->theme);
        $formStep->setChildren([
            'form' => $form
        ]);

        $fields = $form->getData();
        $data = [];
        foreach($fields as $key => $value){
            $data[$key] = setting('shopy_general.' . $key);
        }

        if(!empty($data)){
            $form->populate($data);
        }

        return Shopy::adminView('setup.index', [
            'formStep' => $formStep
        ]);
    }

    public function store(){
        $form = $this->createSetupForm();
        $form->populate();

        $data = $form->getData();

        $settingGroupKey = 'shopy_general';
        foreach($data as $key => $value){
            AppSetting::saveSetting($settingGroupKey . '.' . $key, $value);
        }

        return redirect()->to(Shopy::adminRoute('index'));
    }
}