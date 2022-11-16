
    <?php
    require_once("../autoload.php");
    header ('Content-Type: image/png');
        if(isset($_POST['cadastrar'])){
            $img = $_FILES['img'];
            $name = $img['name'];
            $tmp = $img['tmp_name'];

            $pasta = '../img/professor/24'; //Pasta onde a imagem será salva

            Aluno::insereImagem(24, "professor", $img);
        } //Faz o upload da imagem para o servidor

        function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 60){
            $imgsize = getimagesize($source_file);
            $width = $imgsize[0];
            $height = $imgsize[1];
            $mime = $imgsize['mime'];
            //resize and crop image by center
            switch($mime){
                case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;
                //resize and crop image by center
                case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 6;
                break;
                //resize and crop image by center
                case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 60;
                break;
                default:
                return false;
                break;
            }

            $dst_img = imagecreatetruecolor($max_width, $max_height);
            $src_img = $image_create($source_file);
            $width_new = $height * $max_width / $max_height;
            $height_new = $width * $max_height / $max_width;

            if($width_new > $width){
                $h_point = (($height - $height_new) / 2);
                imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
            } else{
                $w_point = (($width - $width_new) / 2);
                imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
            }
            $image($dst_img, $dst_dir, $quality);
            if($dst_img)
                imagedestroy($dst_img);
            if($src_img)
                imagedestroy($src_img);
        }
        //Tamanho da Imagem final
        $imagem = resize_crop_image(300, 300, $pasta.'/'.$name, $pasta.'/'.$name);
        if($imagem)
            header('Location: teste.php');
    ?>