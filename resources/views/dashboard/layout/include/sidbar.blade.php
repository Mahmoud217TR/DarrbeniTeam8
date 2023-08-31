<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
</script>

<ul class="nav nav-list">
    <li class="{{ (Request::route()->getName() == 'dash.index') ? 'active' : '' }}">
        <a href="{{ route('dash.index') }}">

            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text">Dashboard </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'category.index') ? 'active' : '' }}">
        <a href="{{ route('category.index') }}">

            <i  class="category-icon ace-icon glyphicon glyphicon-home"></i>
          <span class="category-text active" >Category </span>

        </a>

        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'collage.index') ? 'active' : '' }}">
        <a href="{{ route('collage.index') }}">

            <i class="menu-icon fa fa-tag"></i>
            <span class="menu-text">Collage </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'specialization.index') ? 'active' : '' }}">
        <a href="{{ route('specialization.index') }}">

            <i class="menu-icon ace-icon glyphicon glyphicon-envelope"></i>
            <span class="menu-text">Specialization </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'course.index') ? 'active' : '' }}">
        <a href="{{ route('course.index') }}">

            <i  class="menu-icon ace-icon fa fa-globe"></i>
          <span class="menu-text active" >Course </span>

        </a>

        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'courseQuestion.index') ? 'active' : '' }}">
        <a href="{{ route('courseQuestion.index') }}">

            <i  class="menu-icon  ace-icon fa fa-bullhorn"></i>
          <span class="menu-text active" >Course Question</span>
          
        </a>
        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'courseAnswers.index') ? 'active' : '' }}">
        <a href="{{ route('courseAnswers.index') }}">

            <i  class="menu-icon  ace-icon glyphicon glyphicon-pencil"></i>
          <span class="menu-text active" >Course Answers</span>

        </a>

        <b class="arrow"></b>
    </li>
        <li class="{{ (Request::route()->getName() == 'nationalQuestion.index') ? 'active' : '' }}">
        <a href="{{ route('nationalQuestion.index') }}">

            <i  class="menu-icon  ace-icon fa fa-camera"></i>
          <span class="menu-text active" >National Question </span>
          
        </a>
        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'nationalAnswer.index') ? 'active' : '' }}">
        <a href="{{ route('nationalAnswer.index') }}">

            <i  class="menu-icon  ace-icon fa fa-gavel"></i>
          <span class="menu-text active" >National Answer</span>
          
        </a>
        <b class="arrow"></b>
    </li>
    <li class="{{ (Request::route()->getName() == 'notification.index') ? 'active' : '' }}">
        <a href="{{ route('notification.index') }}">

            <i  class="menu-icon  ace-icon fa fa-briefcase"></i>
          <span class="menu-text active" >Notification </span>
          
        </a>
        <b class="arrow"></b>
    </li>
   
    
    <li class="{{ (Request::route()->getName() == 'slider.index') ? 'active' : '' }}">
        <a href="{{ route('slider.index') }}">

            <i  class="menu-icon ace-icon fa fa-gift"></i>
          <span class="menu-text active" >Slider</span>
          
        </a>
        <b class="arrow"></b>
    </li> 
    {{-- 
     
      --}}
     

    

</ul><!-- /.nav-list -->

<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<!-- /section:basics/sidebar.layout.minimize -->
<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>