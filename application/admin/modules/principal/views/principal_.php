<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" xml:lang="pt-br" lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">

    <head>        
        <?php $this->load->file("application/admin/modules/complementos/temas/" . $tema . "/head.php") ?>
    </head>

    <body>
        <?php $this->load->file("application/admin/modules/complementos/temas/" . $tema . "/body_top.php") ?>
        <!-- Content wrapper -->
        <div class="wrapper">

            <!-- Menu de Navegação -->
            <?php echo $menu ?>

            <!-- Conteudo Cambiável do site -->
            <div class="content">
                <div class="title"><h5>Dashboard</h5></div>
                <?php if ($analytics) { ?>
                <?php 
                    $dados = "";
                    foreach ($analytics as $result){
                                          
                        /*Formater data*/
                        $ano = substr($result->getDate(), -8, 4);
                        $mes = substr($result->getDate(), -4, 2);
                        $dia = substr($result->getDate(), -2);
                        
                        $key = $result->getPageviews();
                        $value = $result->getVisits();
                        $data = $dia . "/" . $mes . "/" . $ano;
                        $str .= "['".$data."', ".$value.", ".$key."],";
                    } 
                    
                    $dados = substr($str, 0, strlen($str) - 1);
                    
                ?>
                <div id="graph">Loading...</div>
                <script type="text/javascript">
	
                        var myData = new Array(
                                            <?php echo $dados; ?>
                                        );
                        var myChart = new JSChart('graph', 'bar');
                        myChart.setDataArray(myData);
                        myChart.setTitle('Visualizações dos acessos em seu website');
                        myChart.setTitleColor('#8E8E8E');
                        myChart.setAxisNameX('');
                        myChart.setAxisNameY('');
                        myChart.setAxisNameFontSize(16);
                        myChart.setAxisNameColor('#999');
                        myChart.setAxisValuesAngle(30);
                        myChart.setAxisValuesColor('#777');
                        myChart.setAxisColor('#B5B5B5');
                        myChart.setAxisWidth(1);
                        myChart.setBarValuesColor('#2F6D99');
                        myChart.setAxisPaddingTop(60);
                        myChart.setAxisPaddingBottom(60);
                        myChart.setAxisPaddingLeft(45);
                        myChart.setTitleFontSize(11);
                        myChart.setBarColor('#2D6B96', 1);
                        myChart.setBarColor('#9CCEF0', 2);
                        myChart.setBarBorderWidth(0);
                        myChart.setBarSpacingRatio(8);
                        myChart.setBarOpacity(0.9);
                        myChart.setFlagRadius(1);
                        //myChart.setTooltip(['North America', 'Click me', 1], callback);
                        myChart.setTooltipPosition('nw');
                        myChart.setTooltipOffset(3);
                        myChart.setLegendShow(true);
                        myChart.setLegendPosition('right top');
                        myChart.setLegendForBar(1, 'Visitantes');
                        myChart.setLegendForBar(2, 'Visualizações');
                        myChart.setSize(750, 321);
                        myChart.setGridColor('#C6C6C6');
                        myChart.draw();

//                        function callback() {
//                                alert('User click');
//                        }

                </script>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php $this->load->file("application/admin/modules/complementos/temas/" . $tema . "/body_bottom.php") ?>
        
    <style type="text/css">
        div#graph > div { display: none; }
    </style>
    </body>
</html>