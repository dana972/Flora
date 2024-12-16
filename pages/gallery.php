<?php
require_once 'config/config.php'; 

try {
    // Query to fetch gallery images
    $stmt = $pdo->prepare("SELECT image_url, name, delay_time FROM gallery");
    $stmt->execute();
    $galleryItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching gallery items: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Gallery</title>
    <link rel="stylesheet" href="path_to_your_css.css"> <!-- Include your CSS -->
</head>
<body>
<div class="container-fluid attractions py-5" style="margin-top: 100px;">
    <div class="container attractions-section py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 style="color: #CB9DF0; font-weight: bolder; font-size: xx-large;">Flora Shop</h4>
            <h1 class="display-5 text-white mb-4">Explore Our Beautiful Bouquets and Plants</h1>
            <p class="text-white mb-0">Discover a curated selection of vibrant bouquets and lush indoor plants, perfect for adding beauty and natural elegance to your home and special occasions.</p>
        </div>
        <div class="owl-carousel attractions-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php if (!empty($galleryItems)): ?>
                <?php foreach ($galleryItems as $item): ?>
                    <div class="attractions-item wow fadeInUp" data-wow-delay="<?= htmlspecialchars($item['delay_time']) ?>s">
                        <img src="<?= htmlspecialchars($item['image_url']) ?>" class="img-fluid rounded w-100" alt="<?= htmlspecialchars($item['name']) ?>">
                        <a href="#" class="attractions-name"><?= htmlspecialchars($item['name']) ?></a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-white">No images available in the gallery.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
