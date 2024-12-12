<?php
// Include database configuration
include 'config/config.php';

// Fetch team members from the database
$query = "SELECT * FROM team";
$stmt = $pdo->prepare($query);
$stmt->execute();
$teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="position-relative d-inline ps-4" style="color: #CB9DF0;font-weight: bolder;font-size:xx-large;">Our Team</h6>
            <h2 class="mt-2">Meet The Team Behind Flora</h2>
        </div>
        <div class="row g-4">
            <?php if (count($teamMembers) > 0): ?>
                <?php foreach ($teamMembers as $member): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 d-flex flex-column align-items-center mt-4 pt-5" style="width: 75px;">
                                    <?php if (!empty($member['facebook_link'])): ?>
                                        <a class="btn bg-white my-1 social-icon" href="<?= htmlspecialchars($member['facebook_link']) ?>"><i class="fab fa-facebook-f"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty($member['twitter_link'])): ?>
                                        <a class="btn bg-white my-1 social-icon" href="<?= htmlspecialchars($member['twitter_link']) ?>"><i class="fab fa-twitter"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty($member['instagram_link'])): ?>
                                        <a class="btn bg-white my-1 social-icon" href="<?= htmlspecialchars($member['instagram_link']) ?>"><i class="fab fa-instagram"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty($member['linkedin_link'])): ?>
                                        <a class="btn bg-white my-1 social-icon" href="<?= htmlspecialchars($member['linkedin_link']) ?>"><i class="fab fa-linkedin-in"></i></a>
                                    <?php endif; ?>
                                </div>
                                <img class="img-fluid rounded w-100" src="<?= htmlspecialchars($member['image']) ?>" alt="<?= htmlspecialchars($member['name']) ?>">
                            </div>
                            <div class="px-4 py-3">
                                <h5 class="fw-bold m-0"><?= htmlspecialchars($member['name']) ?></h5>
                                <small><?= htmlspecialchars($member['designation']) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No team members found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Team End -->
