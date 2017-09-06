<?php

namespace app\components;

use Yii;

class CustomActiveRecord extends \yii\db\ActiveRecord
{
	public function softDelete()
	{
		$this->status_hapus = 1;
		$this->save();
	}
}