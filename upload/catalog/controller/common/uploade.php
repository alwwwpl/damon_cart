<?php
class ControllerCommonUploade extends Controller {
    public function index(){
        $picname = $_FILES['mypic']['name'];
        $picsize = $_FILES['mypic']['size'];
        if ($picname != "") {
            if ($picsize > 1024000) {
                echo '图片大小不能超过1M';
                exit;
            }
            $type = strstr($picname, '.');
            if ($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".GIF" && $type != ".JPG" && $type != ".PNG") {
                echo '图片格式不对！';
                exit;
            }
            $rand = rand(100, 999);
            $pics = date("YmdHis") . $rand . $type;
            //上传路径
            $pic_path = "./image/catalog/upload/image/". $pics;
            move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
        }
        $size = round($picsize/1024,2);
        $arr = array(
            'name'=>$picname,
            'pic'=>$pics,
            'size'=>$size
        );
        echo json_encode($arr);
    }

    public function delimg(){
        $filename = $_POST['imagename'];
        if(!empty($filename)){
            unlink('./image/catalog/upload/image/'.$filename);
            echo '1';
        }else{
            echo '删除失败.';
        }
    }
}
?>