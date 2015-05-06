<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>
<!-- Start K2 Category Layout -->
<div class="row itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<!-- End Page title -->
	<?php endif; ?>

	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
	<div class="itemListCategoriesBlock col-md-12">

		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
		<div class="itemListCategory row">
			<div class="col-md-12">
				<?php if($this->params->get('catImage') && $this->category->image): ?>
				<!-- Category image -->
				<img alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
				<?php endif; ?>

				<?php if($this->params->get('catTitle')): ?>
				<!-- Category title -->
				<h2><?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?></h2>
				<?php endif; ?>

				<?php if($this->params->get('catDescription')): ?>
				<!-- Category description -->
				<p><?php echo $this->category->description; ?></p>
				<?php endif; ?>

				<!-- K2 Plugins: K2CategoryDisplay -->
				<?php echo $this->category->event->K2CategoryDisplay; ?>

				<div class="clr"></div>
			</div>
		</div>
		<?php endif; ?>

		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
		<div class="itemListSubCategories row">
				<?php $countCats = count($this->subCategories) ?>
				<?php foreach($this->subCategories as $key=>$subCategory): ?>

				<article class="subCategoryContainer col-md-<?php echo 12 / $countCats ?> <?php echo $lastContainer; ?>">
					<div class="subCategory">
						<?php if($this->params->get('subCatImage') && $subCategory->image): ?>
						<!-- Subcategory image -->
						<a class="thumbnail" class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
							<img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" />
						</a>
						<?php endif; ?>

						<?php if($this->params->get('subCatTitle')): ?>
						<!-- Subcategory title -->
						<h2>
							<a href="<?php echo $subCategory->link; ?>">
								<?php echo $subCategory->name; ?>
							</a>
						</h2>
						<?php endif; ?>

						<?php if($this->params->get('subCatDescription')): ?>
						<!-- Subcategory description -->
						<p><?php echo $subCategory->description; ?></p>
						<?php endif; ?>

						<!-- Subcategory more... -->
						<!--<a class="subCategoryMore" href="<?php echo $subCategory->link; ?>">
							<?php echo JText::_('K2_VIEW_ITEMS'); ?>
						</a>-->
					</div>
				</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
		<!-- Item list -->
		<div class="itemList row">
			<?php if(isset($this->leading) && count($this->leading)): ?>
			<!-- Leading items -->
			<div id="itemListLeading" class="col-md-12">
				<?php $iterRow = 1; ?>
				<?php foreach($this->leading as $key=>$item): ?>
				<?php if (($iterRow % $this->params->get('num_leading_columns')) == 1 && $this->params->get('num_leading_columns') != $itemRow): ?>
				<div class="row itemContainerRow">
				<? endif; ?>
						<div class="itemContainer <?php echo (count($this->leading)==1) ? '' : 'col-md-'.number_format(12/$this->params->get('num_leading_columns'), 0).'"'; ?>">
						<?php
							// Load category_item.php by default
							$this->item=$item;
							echo $this->loadTemplate('item');
						?>
						</div>
				<?php if (($iterRow % $this->params->get('num_leading_columns')) == 0 && $this->params->get('num_leading_columns') != $itemRow): ?>
				</div>
				<?php endif; ?>
				<?php $iterRow++; ?>
				<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>
