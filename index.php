<?php
	defined('_JEXEC') or die;
	unset(
			$this->_scripts[$this->baseurl.'/media/system/js/mootools-core.js'],
			$this->_scripts[$this->baseurl.'/media/system/js/mootools-more.js'],
			$this->_scripts[$this->baseurl.'/media/system/js/core.js'],
			$this->_scripts[$this->baseurl.'/media/system/js/caption.js'],
			$this->_scripts[$this->baseurl.'/media/system/js/modal.js'],
			$this->_styleSheets[$this->baseurl.'/media/system/css/modal.css']
	);
	$doc = JFactory::getDocument();
	if (isset($doc->_script['text/javascript'])){
		$doc->_script['text/javascript'] =
		preg_replace('%jQuery\(function\(\$\)\s*{\s*SqueezeBox\.initialize\(\s*{\}\);\s*SqueezeBox\.assign\(\$\(\'a\.modal\'\)\.get\(\),\s*{\s*parse:\s*\'rel\'\s*\}\);\s*\}\);\s*%', '', $doc->_script['text/javascript']);

		if (empty($doc->_script['text/javascript'])) unset($doc->_script['text/javascript']);
	}
	if (isset($this->_script['text/javascript'])) { $this->_script['text/javascript'] = preg_replace('%window\.addEvent\    (\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%',     '', $this->_script['text/javascript']);
		if (empty($this->_script['text/javascript'])) unset($this->_script['text/javascript']);}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="" />
	<jdoc:include type="head" />
	<?php
		$doc->setGenerator('');
		$doc->addStyleSheet('/templates/naprokat/css/bootstrap.min.css');
        $doc->addStyleSheet('/templates/naprokat/css/bootstrap-theme.min.css');
        $doc->addStyleSheet('/templates/naprokat/css/style.css');

        $doc->addScript('/templates/naprokat/js/bootstrap.min.js');
		$doc->addScript('/templates/naprokat/js/bigSlide.min.js');

        $aSide = 12;
		$divFooter = 0;
		$footerExist = '
			html, body {height: 100%; width: 100%; margin: 0px;}
			.page {min-height: 100%; height: auto !important; height: 100%; margin-top: 20px;}
			.wrap {padding-bottom: 100px;}
			footer {height: 100px; margin-top: -100px;}';
		$menuExist = '
			@media(max-width: 1000px) {
				body { padding-top: 70px; }
			}
			@media(min-width: 1001px) {
				body { padding-top: 30px; }
			}';
	?>


    <!--[if IE]>";
            <script src="/templates/naprokat/js/html5shiv.min.js" type="text/javascript"></script>
            <script src="/templates/naprokat/js/respond.min.js" type="text/javascript"></script>
    <![endif]-->
</head>
<body>
	<div class="page">
		<div class="container-fluid wrap">
			<?php if ($this->countModules('mainmenu')) : ?>
				<?php $doc->addStyleDeclaration($menuExist); ?>
				<script>
					jQuery.noConflict()(function ($) {
						if ($( document ).width() >= 910 ) {
							$('.navbar.push').remove();

						} else if ($( document ).width() <=909 ) {
							$('li.dropdown > a').attr("data-toggle", "dropdown");
							$('<div class="row logo-row"><div class="col-md-12"><img src="/templates/naprokat/images/logo.jpg" alt="Напрокат Кемпинг актив" /></div></div>').prependTo('nav.navbar > div.container-fluid') ;
						}
					});
				</script>
				<nav class="navbar navbar-default navbar-fixed-top">
				   <div class="container-fluid">
				   		<div class="row"><div class="col-md-12">
							<div class="navbar push">
								<button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<div class="push pull-left">
									<a href="#menu" type="button" data-toggle="collapse" class="navbar-toggle pull-right menu-link">
										<div class="cam-menu">
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</div>
										<span>Каталог</span>
									</a>
								</div>
							</div>
						</div></div>
					</div>
					<div class="collapse navbar-collapse">
						<jdoc:include type="modules" name="mainmenu" style="default"/>
					</div>

				</nav>
			<?php endif; ?>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<?php if ($this->countModules('aside')) : ?>
							<?php $aSide = $aSide - 3; ?>
							<aside class="col-md-3 panel" id="menu" role="navigation">
								<jdoc:include type="modules" name="aside" style="default"/>
								<script>
									jQuery.noConflict()(function ($) {
										if ($( document ).width() <= 909 ) {
											$(document).ready(function() {
												$('.menu-link').bigSlide();
											});
										}
									});
								</script>
							</aside>
						<?php endif; ?>
						<section class="col-md-<?php echo $aSide; ?>">
							<jdoc:include type="component" />
						</section>
					</div>
				</div>
			</div>
		</div>
   	</div>
    <?php
	if ($this->countModules('footer-left')) {
		$divFooter += 1;
	};
	if ($this->countModules('footer-center')) {
		$divFooter += 1;
	};
	if ($this->countModules('footer-right')) {
		$divFooter += 1;
	};
	if ($divFooter != 0) : ?>
		<?php $doc->addStyleDeclaration($footerExist); ?>
		<div class="footer container-fluid">
			<footer class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<?php if ($this->countModules('footer-left')) : ?>
							<div class="col-md-<?php echo $aSide / $divFooter; ?>">
								<jdoc:include type="modules" name="footer-left" style="default"/>
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('footer-center')) : ?>
							<div class="col-md-<?php echo $aSide / $divFooter; ?>">
								<jdoc:include type="modules" name="footer-center" style="default"/>
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('footer-right')) : ?>
							<div class="col-md-<?php echo $aSide / $divFooter; ?>">
								<jdoc:include type="modules" name="footer-right" style="default"/>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</footer>
		</div>
	<?php endif; ?>
</body>
</html>
