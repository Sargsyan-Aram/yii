<li <?php if (isset($category['children'])):?>class="parent_category" <?php else:?>class="child_category"<?php endif;?>>
    <a href="<?php if (isset($category['children'])):?>#<?php else: echo \yii\helpers\Url::to(['categories/views','id'=>$category['id']]); endif;?>">
        <?=$category['name'];?>
        <?php if (isset($category['children'])):?>
            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        <?php endif;?>
    </a>
    <?php if (isset($category['children'])):?>
        <ul>
            <?=$this->getMenuHtml($category['children']);?>
        </ul>
    <?php endif;?>
</li>