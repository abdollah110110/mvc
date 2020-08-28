<?php
class SiteController extends Controller {

	public function actionIndex() {
		$categories = (new Categories())->findAll();
		$this->render( 'index', compact( 'categories' ) );
	}

}
