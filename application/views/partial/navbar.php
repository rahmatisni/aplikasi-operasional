<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                <i class="fa fa-bars"></i>
            </button>
            <button type="button" class="sidebar-toggle">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand text-size-24" href="#"> 
            <?php 

            $a=explode("_",$this->uri->segment(2));
            if(count($a)>=2)
            {   
                echo ucfirst($a[0])." ".ucfirst($a[1]);
            }else
            {
                echo ucfirst(($this->uri->segment(2)==''? 'dashboard' : $this->uri->segment(2))); 
            }

            ?></a>
        </div>
        <div class="collapse navbar-collapse" id="menu">
            <form class="navbar-form navbar-right">
                <div class="input-group">
                    <input type="text" class="form-control round" placeholder="Search">
                    <span class="input-group-btn">
                        <a href="javascript:void(0)" class="btn btn-default round"><i class="fa fa-search"></i></a>
                    </span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->nama; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('auth/logout')?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>