<?php
namespace App\Controller\Component;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;

class ImageUploader
{
    public static function fileUpload ($file = null,$dir = null, $limitFileSize = 1024 * 1024){
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

            // ファイルサイズのチェック
            if ($fileInfo->size() > $limitFileSize) {
                throw new RuntimeException('ファイルサイズが大きすぎます。');
            }

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
            $uploadFile = sha1_file($file["tmp_name"]) . "." . $ext;

            // ファイルの移動
            if (!@move_uploaded_file($file["tmp_name"], $dir . "/" . $uploadFile)){
                throw new RuntimeException('ファイルのアップロードに失敗しました。');
            }

            // 処理を抜けたら正常終了
//            echo 'File is uploaded successfully.';

        } catch (RuntimeException $e) {
            throw $e;
        }
        return $uploadFile;
    }
}
