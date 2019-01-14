<?php
/**
 * Created by PhpStorm.
 * User: Aram
 * Date: 1/7/2019
 * Time: 6:16 PM
 */

namespace app\components;
use common\models\Categories;
use yii\base\Widget;
use Yii;


class MenuWidget extends Widget
{
    public $tmp;
    public $data;
    public $tree;
    public $menuHtml;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if($this->tmp === null || $this->tmp != 'select'){
            $this->tmp = 'menu';
        }
        $this->tmp .= '.php';
    }
    public function run(){
        $menu = Yii::$app->cache->get('menu');
        if ($menu) return $menu;
        $this->data = Categories::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree($this->data);
        $this->menuHtml = $this->getMenuHtml($this->tree);
        Yii::$app->cache->set('menu',$this->getMenuHtml($this->tree),30);
        return $this->menuHtml;
    }
    public function getTree($elements, $parentId = 0) {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->getTree($elements, $element['id']);
                if ($children) {
                    $element['children'] =  $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category){
            $str .= $this->catToTamplate($category);
        }
        return $str;
    }
    protected function catToTamplate($category){
        ob_start();
        include __DIR__.'/menu_tpl/'.$this->tmp;
        return ob_get_clean();
    }

}