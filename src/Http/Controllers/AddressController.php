<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\Address;
use bachphuc\LaravelHTMLElements\Components\Table;
use bachphuc\LaravelHTMLElements\Http\Controllers\ManageBaseController;

class AddressController extends ManageBaseController
{
    protected $modelName = 'address';
    protected $model = '\bachphuc\Shopy\Models\Address';
    protected $activeMenu = 'address';
    protected $modelRouteName = 'addresses';

    protected $sectionName = 'account-content';
    protected $isShowCreateButton = true;
    protected $theme = 'bootstrap';

    public function getLayout(){
        return Shopy::viewPath('account.account-layout');
    }

    public function createTableFields(){
        return [
            'id',
            'first_name' => [
                'title' => trans('shopy::lang.first_name')
            ],
            'last_name' => [
                'title' => trans('shopy::lang.last_name')
            ],
            'phone' => [
                'title' => trans('shopy::lang.phone')
            ]
        ];
    }

    public function processTable(&$table){
        $table->setAttribute('deleteIcon', trans('shopy::lang.delete'));
        $table->setAttribute('editIcon', trans('shopy::lang.edit'));
    }

    public function createFormElements($isUpdate = false){
        $elements = [
            'first_name' => [
                'title' => trans('shopy::lang.first_name'),
                'placeholder' => 'Nguyen'
            ],
            'last_name' => [
                'title' => trans('shopy::lang.last_name'),
                'placeholder' => 'Van A'
            ],
            'phone' => [
                'title' => trans('shopy::lang.phone'),
                'placeholder' => shopy_trans('lang.input_phone')
            ],
            'province' => [
                'title' => trans('shopy::lang.province'),
                'placeholder' => shopy_trans('lang.province')
            ], 
            'district' => [
                'title' => trans('shopy::lang.district'),
                'placeholder' => shopy_trans('lang.district')
            ], 
            'ward' => [
                'title' => trans('shopy::lang.ward'),
                'placeholder' => shopy_trans('lang.ward')
            ],
            'address' => [
                'title' => trans('shopy::lang.address'),
                'placeholder' => shopy_trans('lang.address')
            ],
        ];

        return $elements;
    }

    public function getBreadcrumbs(){
        return [];
    }

    public function getPageTitles(){
        return [
            'index' => trans('shopy::lang.shipping_address')
        ];
    }
}