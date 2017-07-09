<?php
namespace App\Controller\Component;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;

class ImageUploader
{
    /**
     * 画像をアップロードする
     *
     * @param null $file
     * @param null $dir
     * @param int $limitFileSize
     * @return string
     */
    public function fileUpload ($file = null, $dir = SAVE_IMG_PATH, $limitFileSize = 1024 * 1024)
    {
        try {
            // ファイルを保存するフォルダ $dirの値のチェック
            if ($dir){
                if(!file_exists($dir)){
                    throw new RuntimeException('指定のディレクトリがありません。');
                }
            } else {
                throw new RuntimeException('ディレクトリの指定がありません。');
            }

            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($file['error']) || is_array($file['error'])){
                throw new RuntimeException('Invalid parameters.');
            }

            // エラーのチェック
            switch ($file['error']) {
                case 0:
                    break;
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('ファイルを送信できませんでした。');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('ファイルサイズが大きすぎます。');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // ファイル情報取得
            $fileInfo = new File($file["tmp_name"]);

            // ファイルタイプのチェックし、拡張子を取得
            if (false === $ext = array_search($fileInfo->mime(),
                    ['jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',],
                    true)){
                throw new RuntimeException('拡張子が正しくありません。');
            }

            // ファイル名の生成
//            $uploadFile = $file["name"] . "." . $ext;
            $uploadFile = date('YmdHis').sha1_file($file['tmp_name']).'.'. $ext;

            // ファイルサイズのチェック
            if ($fileInfo->size() > $limitFileSize) {
                $this->resizeImageUpload($file, RESIZE_IMG_WIDTH, $dir, $uploadFile);
                return $uploadFile;
//                throw new RuntimeException('ファイルサイズが大きすぎます。');
            }

            // ファイルの移動
            if (!@move_uploaded_file($file["tmp_name"], $dir . '/' . $uploadFile)){
                throw new RuntimeException('ファイルのアップロードに失敗しました。');
            }

            // 処理を抜けたら正常終了
//            echo 'File is uploaded successfully.';

        } catch (RuntimeException $e) {
            throw $e;
        }
        return $uploadFile;
    }

    /**
     * 画像を削除する
     *
     * @param null $fileName
     * @param null $dir
     */
    public function fileDelete($fileName = null, $dir = SAVE_IMG_PATH)
    {
        try {
            $delFile = new File($dir .'/'. $fileName);
            // ファイル削除処理実行
            if($delFile->delete()) {
                $result['file'] = '';
                $result['error'] = '';
            } else {
                $result['file'] = $fileName;
                $result['error'] = 'ファイルの削除ができませんでした';
            }
        } catch (RuntimeException $e){
            $result['file'] = $fileName;
            $result['error'] = $e->getMessage();
        }
    }

    /**
     * 画像をリサイズしてアップロードする
     *
     * @param $file
     * @param $newWidth
     * @param string $dir
     * @param $fileName
     */
    public function resizeImageUpload($file, $newWidth, $dir = SAVE_IMG_PATH, $fileName)
    {
        list($width, $height, $type) = getimagesize($file['tmp_name']);
        $newHeight = round($height * $newWidth / $width);
        $empImg = imagecreatetruecolor($newWidth, $newHeight);
        switch($type){
            case IMAGETYPE_JPEG:
                $newImage = imagecreatefromjpeg($file['tmp_name']);
                break;
            case IMAGETYPE_GIF:
                $newImage = imagecreatefromgif($file['tmp_name']);
                break;
            case IMAGETYPE_PNG:
                imagealphablending($empImg, false);
                imagesavealpha($empImg, true);
                $newImage = imagecreatefrompng($file['tmp_name']);
                break;
        }
        imagecopyresampled($empImg, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        switch($type){
            case IMAGETYPE_JPEG:
                imagejpeg($empImg, $dir.'/'.$fileName);
                break;
            case IMAGETYPE_GIF:
                $bgcolor = imagecolorallocatealpha($newImage, 0, 0, 0 , 127);
                imagefill($empImg, 0, 0, $bgcolor);
                imagecolortransparent($empImg, $bgcolor);
                imagegif($empImg, $dir.'/'.$fileName);
                break;
            case IMAGETYPE_PNG:
                imagepng($empImg, $dir.'/'.$fileName);
                break;
        }
        imagedestroy($empImg);
        imagedestroy($newImage);
    }

}
