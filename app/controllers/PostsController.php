<?php
class PostsController extends Controller {

	public function actionView($params) {
		$post = (new Posts())->findByPk($params['id']);
		$post->view++;
		$post->save();
		$this->render( 'view', compact( 'post' ) );
	}

}
