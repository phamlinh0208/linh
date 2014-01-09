<?php $this->beginContent('//layouts/main'); ?>

<style type="text/css">

    #warning span{
        color:red;
    }
</style>
<script>
 $(document).ready(function(){
 	$(".active").find("a").css("color","#007DBB");
 	$(".active").parents(".dir").css("color","#007DBB");
 })
</script>
<div class="container">
    <div class="span-5">
        <?php
		echo "<span style='font-size:20px; margin-left: 10px; color:#007DBB'>".Yii::t('dictionary','function_menu')."</span>";
        $this->widget('ext.emenu.EMenu', array(
            'theme' => 'default',
            'vertical' => true,
            'items' => array(
                array(
                    'label' => Yii::t('dictionary','login_history'),
                    'url' => array('/Feedback/admin'),
                    'visible' => (Yii::app()->user->getIsSuperuser() == 1),
                    'active' => Yii::app()->controller->id=='feedback'?true:false,
                ),
                array(
                    'label' => Yii::t('dictionary','department'),
                    'items' => array(

                        array(
                            'label' => Yii::t('dictionary','department'),
                            'url' => array('/Department/admin')
                        ),
                        array(
                            'label' => Yii::t('dictionary','staff'),
                            'url' => array('/Staff/admin')
                        ),
                    ),
                    'visible' => (Yii::app()->user->getIsSuperuser() == 1),
                    'active' => Yii::app()->controller->id=='department'?true:(Yii::app()->controller->id=='staff'?true:false),               
                ),
                array(
                    'label' => Yii::t('dictionary','posm'),
                    'items' => array(
                        array(
                            'label' => Yii::t('dictionary','posm_list'),
                            'url' => array('/POSM/admin')
                        ),
                        array(
                            'label' => Yii::t('dictionary','posm_survey'),
                            'url' => array('/DepPosm/admin')
                        ),
                    ),
                    'visible' => (Yii::app()->user->getIsSuperuser() == 1),
                    'active' => Yii::app()->controller->id=='posm'?true:(Yii::app()->controller->id=='depposm'?true:false),
                ),
                array(
                    'label' => Yii::t('dictionary','competitor'),
                    'items' => array(
                        array(
                            'label' => Yii::t('dictionary','competitor_list'),
                            'url' => array('/Competitor/admin')
                        ),
                        array(
                            'label' => Yii::t('dictionary','competitor_survey'),
                            'url' => array('/Depcompetitor/admin')
                        ),
                    ),
                    'visible' => (Yii::app()->user->getIsSuperuser() == 1),
                    'active' => Yii::app()->controller->id=='competitor'?true:(Yii::app()->controller->id=='depcompetitor'?true:false), 
                ),
                array(
                    'label' => Yii::t('dictionary','manager_product'),
                    'url' => array('/Product/admin'),
                    'visible' => (Yii::app()->user->getIsSuperuser() == 1),
                    'active' => Yii::app()->controller->id=='product'?true:false, 
                ),
/*
                array(
                    'label' => Yii::t('dictionary','promotion'),
                    'items' => array(
                        array(
                            'label' => Yii::t('dictionary','app_promotion'),
                            'url' => array('/Promotion/admin')
                        ),

                    ),
                    'visible' => (Yii::app()->user->getIsSuperuser() == 1)
                ),
*/
                array(
                    'label' => Yii::t('dictionary','user_manager'),
                    'url' => array('/user/admin'),
                    'visible' => (Yii::app()->user->getIsSuperuser() == 1),
                    'active' => Yii::app()->controller->id=='admin'?true:false, 
                ),

/*
                array(
                    'label' => Yii::t('dictionary','app_param'),
                    'items' => array(
                        array(
                            'label' => Yii::t('dictionary','app_manager'),
                            'url' => array('/appParam/admin')
                        ),

                    ),
                     'visible' => (Yii::app()->user->getIsSuperuser() == 1)
                ),
*/

              ), )  );
        ?>

    </div>
    <div id="content" class="span-24">
        <div>
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
        </div>

        <?php echo $content; ?>
    </div><!-- content -->
</div>
<?php $this->endContent(); ?>


