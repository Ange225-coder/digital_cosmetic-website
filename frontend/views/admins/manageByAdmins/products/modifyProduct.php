<?php
    require_once('../../../../../backend/controller/adminManagementCtrl/retrieveAProductDataCtrl.php');

    $product_data = retrieveAProductDataCtrl();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Modifier <?= $product_data['p_name'] ?></title>
        <link rel="stylesheet" type="text/css" href="../../../../../public/css-prefixed/productModification.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

        <section>

            <div class="main-content">
                <div class="img">
                    <?php if(!empty($product_data['p_img'])): ?>
                        <?php $imgData = base64_encode($product_data['p_img']); ?>

                        <img src="data:;base64, <?= $imgData ?>" alt="<?= $product_data['p_name'] ?>">
                    <?php endif; ?>
                </div>

                <hr >

                <div class="product-modification">
                    <h2>Modification du produit "<?= $product_data['p_name']; ?>"</h2>

                    <form method="POST" action="../../../../../backend/router/router.php?action=modifyProductCtrl&amp;product_id=<?= $product_data['product_id'] ?>">

                        <p class="error">
                            <?php if(isset($error_product_modification)): ?>
                                <?= $error_product_modification; ?>
                            <?php endif; ?>
                        </p>

                        <div class="input-block--grid">
                            <div class="input-block">
                                <label for="new_p_name">Renommer le produit <span>*</span></label>
                                <input type="text" name="new_p_name" id="new_p_name" value="<?= $product_data['p_name']; ?>" required>
                            </div>

                            <div class="textarea-block">
                                <label for="new_p_description"> Nouvelle description <span>*</span></label>
                                <textarea name="new_p_description" id="new_p_description" required><?= $product_data['p_description'] ?></textarea>
                            </div>

                            <div class="input-block">
                                <label for="new_p_type"> Changer le type du produit <span>*</span></label>
                                <input type="text" name="new_p_type" id="new_p_type" value="<?= $product_data['p_type']; ?>" required>
                            </div>

                            <div class="input-block">
                                <label for="new_p_quantity"> nouvelle quantité <span>*</span></label>
                                <input type="number" name="new_p_quantity" id="new_p_quantity" min="0" value="<?= $product_data['p_quantity']; ?>" required>
                            </div>

                            <div class="input-block">
                                <label for="new_p_price"> nouveau prix <span>*</span></label>
                                <input type="text" name="new_p_price" id="new_p_price" value="<?= $product_data['p_price']; ?>" required>
                            </div>
                        </div>

                        <div class="btn">
                            <button type="submit">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>