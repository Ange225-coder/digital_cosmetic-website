<?php
    require_once('../../../../../backend/controller/adminManagementCtrl/getProductsCtrl.php');
    require_once('../../../../../backend/controller/paginationsCtrl/paginationManagerCtrl.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Administration | Liste des produits</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../../../../../public/css-prefixed/productList.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <header>
            <h1>
                DIGITAL <span><i class="fa-brands fa-canadian-maple-leaf"></i>COSMETICS</span>
            </h1>

            <h2>Liste des produits</h2>
        </header>

        <hr >

        <section>
            <div class="back-link-block">
                <a href="#" onclick="window.history.back();" title="retour" class="back-link-block--flex">
                    <i class="fa-solid fa-chevron-left"></i><span>Retour</span>
                    <!--<span class="bi bi-chevron-left"></span>-->
                </a>
            </div>

            <div class="details-block">
                <details>
                    <summary>Catégorie <span class="fa-solid fa-chevron-down"></span></summary>

                    <div class="details-content">

                        <p class="details-content__title">Afficher les produits par catégorie</p>

                        <form method="POST" action="../../../../../backend/router/router.php?action=sortProductsCtrl">

                            <p>
                                <?php if(isset($error_sort_product)): ?>
                                    <?= $error_sort_product; ?>
                                <?php endif; ?>
                            </p>

                            <div class="inputForm">
                                <label for="health">Santé</label>
                                <input type="radio" name="category" value="Santé" id="health" required>
                            </div>

                            <div class="inputForm">
                                <label for="cosmetics"> Cosmetics</label>
                                <input type="radio" name="category" value="Cosmetics" id="cosmetics" required>
                            </div>

                            <div class="btn">
                                <button type="submit">Trier</button>
                            </div>
                        </form>
                    </div>
                </details>
            </div>



            <article>
                <?php foreach(getProductsCtrl() as $product): ?>
                    <div class="product">
                        <div class="product--flex">
                            <div class="img">
                                <?php if(!empty($product['p_img'])): ?>
                                    <?php $imgData = base64_encode($product['p_img']); ?>
                                    <?php $imgType = mime_content_type('data://image/jpeg;base64,'.$imgData); ?>
                                    <img src="data:<?= $imgType ?>;base64,<?= $imgData ?>" alt="<?= $product['p_name'] ?>">
                                <?php endif; ?>
                            </div>

                            <div class="features">
                                <p class="category"><?= $product['p_category']; ?></p>

                                <h3 class="name"><?= $product['p_name']; ?></h3>

                                <p class="description"><?= $product['p_description']; ?></p>

                                <div class="sub-features">
                                    <p>
                                        Type: <br >
                                        <span><?= $product['p_type']; ?></span>
                                    </p>

                                    <div></div>

                                    <p>
                                        Produit restant: <br >
                                        <span><?= $product['p_quantity']; ?></span>
                                    </p>

                                    <div></div>

                                    <p>
                                        Prix: <br >
                                        <span><?= $product['p_price'] ?> Fcfa</span>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="links">
                            <a href="modifyProduct.php?product_id=<?= $product['product_id']; ?>">
                                <span class="fa-solid fa-circle-exclamation"></span>
                                Modifier les données du produit
                            </a>

                            <a href="delProduct.php?product_id=<?= $product['product_id']; ?>">
                                <span class="fa-regular fa-trash-can"></span>
                                Retirer l'article
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </article>

            <div class="pagination">
                <?php for($i=1; $i<=getLinkForProductsPagination(); $i++): ?>
                    <?php if(getCurrentPage() != $i): ?>
                    <div>
                        <p>
                            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </p>
                    </div>

                    <?php else: ?>
                        <p>
                            <a><?= $i; ?></a>
                        </p>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </section>

    </body>
</html>