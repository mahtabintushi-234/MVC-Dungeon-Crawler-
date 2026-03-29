<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMP 10260 Assignment 4 - Crawl.io</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        td,th { text-align : center }

        .dialog {
            border : 2px solid black;
            border-radius : 0px 30px 30px 15px;
            margin : 30px;
            padding : 10px;
        }

        .overlap {
            position: relative;
        }

        .bg {
            border : 4px solid black;
            border-radius : 10px
            position: relative;
            z-index: 1;
        }

        .fg {
            position: absolute;
            top: <?php
            if ((isset($TPL['encounter'])) && $TPL['encounter']['img_top']) {
                echo $TPL['encounter']['img_top'];
            } else {
                echo "-60";
            }
            ?>px;
            left: <?php
            if ((isset($TPL['encounter'])) && $TPL['encounter']['img_left']) {
                echo $TPL['encounter']['img_left'];
            } else {
                echo "20";
            }
            ?>px;
            width: <?php
            if ((isset($TPL['encounter'])) && $TPL['encounter']['img_width']) {
                echo $TPL['encounter']['img_width'];
            } else {
                echo "550";
            }
            ?>px;
            z-index: 2;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="overlap">
                    <img src="<?= $TPL['base_path'] ?>img/areas/<?= $TPL["dungeon_background"] ?>" class="img-fluid bg thumbnail" alt="You have been eaten by a Grue">
                    <?php if (isset($TPL["encounter"])) { ?>
                    <img src="<?= $TPL['base_path'] ?>img/encounters/<?= $TPL["encounter"]["image"] ?>" class="fg">
                    <?php }?>
                </div>
            </div>
            <div class="col-6">
                <div class="container">
                    <div class="row">
                        <div class="dialog">
                            Orientation: <?= $_SESSION["orientation"]?>
                        </div>
                    </div>
                    <div class="row">
                        <div class=dialog onclick="window.location.href='<?= $TPL['base_path'] ?>turn/left'">
                            Turn Left
                        </div>
                    </div>

                    <div class="row">
                        <?php if ($TPL['forward'] !== null) { ?>
                        <div class=dialog onclick="window.location.href='<?= $TPL['base_path'] ?>goto/<?= $TPL['forward'] ?>'">
                            Go Forward
                        </div>
                        <?php } else {?>
                        <div class=dialog>
                            Your Path is Blocked!
                        </div>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class=dialog  onclick="window.location.href='<?= $TPL['base_path'] ?>turn/right'">
                            Turn Right
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($TPL["encounter"])) { ?>
            <div class="row">
                <div class=dialog>
                    <?= $TPL["encounter"]["dialog"]; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
