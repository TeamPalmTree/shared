<!--<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn navbar-btn" data-toggle="collapse" data-target="#network-collapse">
                <span class="glyphicon glyphicon-bar"></span>
                <span class="glyphicon glyphicon-bar"></span>
                <span class="glyphicon glyphicon-bar"></span>
            </a>
            <a class="tpt-navigation-emblem" href="#"></a>
            <a class="navbar-brand" href="http://www.teampalmtree.com">Team Palm Tree</a>
            <div id="network-collapse" class="navbar-collapse collapse">
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">PROJECTS</a>
                        <ul class="dropdown-menu">
                            <li><a href="http://www.gdmradio.com">GDM Radio</a></li>
                            <li><a href="https://github.com/TeamPalmTree/cloudcast-full">CloudCast</a></li>
                        </ul>
                    </li>
                    <?php if (Auth::check()): ?>
                        <li><a href="#">LOGGED IN: <?php echo Auth::get_screen_name(); ?></a></li>
                    <?php else: ?>
                        <li><a href="http://authority.teampalmtree.com/authority/login/facebook?callback_url=<?php echo urlencode('http://www.gdmradio.com/promoter/login/'); ?>&redirect_url=<?php echo urlencode('http://www.gdmradio.com'); ?>">LOGIN FACEBOOK</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>--!>