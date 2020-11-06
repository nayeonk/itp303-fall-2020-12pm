<div class="card">
    <img
    src="<?php echo $track["album"]["images"][0]["url"]; ?>"
    class="card-img-top"
    alt="<?php echo $track["name"]; ?>"
    />
    <div class="card-body">
    <h5 class="card-title"><?php echo $track["name"]; ?></h5>
    <p class="card-text">
        <?php echo $track["artists"][0]["name"]; ?> - <span class="font-italic"><?php echo $track["album"]["name"]; ?></span>
    </p>
    </div>
</div>
