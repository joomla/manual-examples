<?php

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Button\PublishedButton;
use Joomla\CMS\Layout\LayoutHelper;

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo Route::_('index.php?option=com_example&view=landmarks'); ?>" method="post" name="adminForm" id="adminForm">

    <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>

    <table class="table">
        <caption class="visually-hidden">
            <?php echo Text::_('COM_EXAMPLE_LANDMARKS_CAPTION'); ?>
        </caption>
        <thead>
            <tr>
                <td class="w-1 text-center">
                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                </td>
                <th scope="col">
                    <?php echo HTMLHelper::_('searchtools.sort', 'JGLOBAL_TITLE', 'title', $listDirn, $listOrder); ?>
                </th>
                <th scope="col" class="w-1 text-center">
                    <?php echo Text::_('JSTATUS'); ?>
                </th>
                <th scope="col">
                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'id', $listDirn, $listOrder); ?>
                </th>
            </tr>
        </thead>
        <tbody><?php foreach ($this->items as $i => $item) :?>
                    <tr>
                        <td class="text-center">
                            <?php echo HTMLHelper::_('grid.id', $i, $item->id, false, 'cid', 'cb', $item->title); ?>
                        </td>
                        <th scope="row">
                            <?php 
                                $url = Route::_('index.php?option=com_example&task=landmark.edit&id=' . $item->id);
                                $linkText = $this->escape($item->title); 
                                echo "<a href='{$url}'>{$linkText}</a>";
                            ?>
                        </th>
                        <td class="text-center">
                            <?php
                                $options = [
                                    'task_prefix' => 'landmarks.',
                                    'id' => 'published-' . $item->id,
                                ];
                                echo (new PublishedButton())->render((int) $item->published, $i, $options);
                            ?>
                        </td>
                        <td>
                            <?php echo (int) $item->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php echo $this->pagination->getListFooter(); ?>
    
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>