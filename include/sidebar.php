<?php
$currentPage = $_GET['page'] ?? 'dashboard';
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="layout.php">
                <!-- <img alt="image" src="assets/img/small_logo.png" class="header-logo" /> -->
                <span class="logo-name"><img class="header-logo" src="assets/img/logo.png" alt=""></span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"><?= $userRole ?> (<?= $userName; ?>)</li>

            <!-- Super Admin Section -->
            <?php if ($userRole == 'super_admin'): ?>
                <li class="<?php echo $currentPage == 'dashboard' ? 'active' : ''; ?>">
                    <a href="layout.php?page=dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['adduser', 'updateuser', 'deleteuser']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>User Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'adduser' ? 'active' : ''; ?>" href="layout.php?page=adduser">Add User</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'updateuser' ? 'active' : ''; ?>" href="layout.php?page=updateuser">Update</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'deleteuser' ? 'active' : ''; ?>" href="layout.php?page=deleteuser">Delete</a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['reportadd', 'reportupdate', 'reportdelete']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="bar-chart-2"></i><span>Reports & Analytics</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'reportadd' ? 'active' : ''; ?>" href="layout.php?page=reportadd">Add Report</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'reportupdate' ? 'active' : ''; ?>" href="layout.php?page=reportupdate">Update</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'reportdelete' ? 'active' : ''; ?>" href="layout.php?page=reportdelete">Delete</a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['systempref', 'systemconfig', 'systemlogo']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="settings"></i><span>System Setting</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'systempref' ? 'active' : ''; ?>" href="layout.php?page=systempref">System Preference</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'systemconfig' ? 'active' : ''; ?>" href="layout.php?page=systemconfig">System Config</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'systemlogo' ? 'active' : ''; ?>" href="layout.php?page=systemlogo">System Logo</a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['notifadd', 'notifupdate', 'notifdelete']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="bell"></i><span>Notifications</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'notifadd' ? 'active' : ''; ?>" href="layout.php?page=notifadd">Add Notification</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'notifupdate' ? 'active' : ''; ?>" href="layout.php?page=notifupdate">Update</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'notifdelete' ? 'active' : ''; ?>" href="layout.php?page=notifdelete">Delete</a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['profile', 'resetpass']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Security</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'profile' ? 'active' : ''; ?>" href="layout.php?page=profile">Profile</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'resetpass' ? 'active' : ''; ?>" href="layout.php?page=resetpass">Reset Password</a></li>
                    </ul>
                </li>
            <?php endif; ?>


            <!-- Admin Section -->
            <?php if ($userRole == 'admin'): ?>
                <li class="<?php echo $currentPage == 'dashboard' ? 'active' : ''; ?>">
                    <a href="layout.php?page=dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>
                <!-- Admin ke dropdowns yahan same logic ke sath add karo -->
                 <li class="dropdown <?php echo in_array($currentPage, ['adduser', 'updateuser', 'deleteuser']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>User Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'adduser' ? 'active' : ''; ?>" href="layout.php?page=adduser">Add User</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'updateuser' ? 'active' : ''; ?>" href="layout.php?page=updateuser">Update</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'deleteuser' ? 'active' : ''; ?>" href="layout.php?page=deleteuser">Delete</a></li>
                    </ul>
                </li>
                <!-- <li class="dropdown <?php echo in_array($currentPage, ['admin_Users', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Admin Users </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'admin_Users' ? 'active' : ''; ?>" href="layout.php?page=admin_Users">List All Admin Users </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add Admin Users</a></li>

                    </ul>
                </li> -->

                <li class="dropdown <?php echo in_array($currentPage, ['admin_manageJobs', 'admin_JobsForm']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Jobs </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'admin_manageJobs' ? 'active' : ''; ?>" href="layout.php?page=admin_manageJobs">Manage Jobs </a></li>
                       
                        <li><a class="nav-link <?php echo $currentPage == 'admin_JobsForm' ? 'active' : ''; ?>" href="layout.php?page=admin_JobsForm">Add New Jobs</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Companies </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Manage Companies </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add Company</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>SEO </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">SEO page list </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">SEO form</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>FAQ'S</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">FAQ list </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">FAQ form</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Blogs </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">All Blogs </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit Blogs</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Testimonial</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Testimonial List </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add New Testimonial</a></li>

                    </ul>
                </li>



                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Site Language </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Site Language </a></li>


                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Location </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Manage Location </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add New Location</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">All Countries</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Countries Details</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">State</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Cities </a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Employer Package </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Manage Employer Package </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add Employer Package </a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Seeker </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Manage Seeker Package </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add Seeker Package</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Job Attribute </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Manage Job Attribute </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add New Job Attribute</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Language Level </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">List of Language Level </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add Language Level</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Career Level </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">List of Career Level </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add Career Level </a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Functional Areas </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Functional Areas </a></li>


                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Gender </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Gender </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit the Gender </a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Industry </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Industry </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add new industry</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Job Experience </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Job Experience </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add new Job Experience</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Job Skill </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Job Skill </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add new Job Skill</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Job Title </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Job Title </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add new Job Title</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Job Types </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Job Types </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Add new Job Type form</a></li>

                    </ul>
                </li>


                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Job Shifts </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Job Shifts </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit the Job Shifts</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Degree Level </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Degree Level </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit the Degree Level</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Degree Types </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Degree Types </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit the Degree Types</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Degree Subjects </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Major Subjects </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit the Major Subjects</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Results Grade </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Results Grade </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit the Results Grade</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Ownership Types </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Ownership Types </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit the Ownership Types</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'admin_addNewadmin']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Salary Periods </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Salary Periods </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'admin_addNewadmin' ? 'active' : ''; ?>" href="layout.php?page=admin_addNewadmin">Edit Salary Periods</a></li>

                    </ul>
                </li>
            <?php endif; ?>


            <!-- Manager/provider Section has done -->
            <?php if ($userRole == 'manager'): ?>
                <li class="<?php echo $currentPage == 'dashboard' ? 'active' : ''; ?>">
                    <a href="layout.php?page=dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_editAccountDetail']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Edit Account Detail</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_editAccountDetail' ? 'active' : ''; ?>" href="layout.php?page=provider_editAccountDetail">Edit Account Detail </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_CompanyPuplicProfile']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Company Public Profile</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_CompanyPuplicProfile' ? 'active' : ''; ?>" href="layout.php?page=provider_CompanyPuplicProfile">Company Public Profile </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_postJob']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Post a job</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_postJob' ? 'active' : ''; ?>" href="layout.php?page=provider_postJob">Post a job </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_managethePostedJob']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Manage Jobs</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_managethePostedJob' ? 'active' : ''; ?>" href="layout.php?page=provider_managethePostedJob">Manage posted job </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_CVSearchPackage']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>CV Search Package</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_CVSearchPackage' ? 'active' : ''; ?>" href="layout.php?page=provider_CVSearchPackage">CV Search Packages </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_paymentHistory']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Payment History</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_paymentHistory' ? 'active' : ''; ?>" href="layout.php?page=provider_paymentHistory">Payment History </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_UnlockUser']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Unlock Users</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_UnlockUser' ? 'active' : ''; ?>" href="layout.php?page=provider_UnlockUser">Unlock Users </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_message']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Company Messages</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_message' ? 'active' : ''; ?>" href="layout.php?page=provider_message">Company Messages </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_CompanyFollowers']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Company Profile</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_CompanyFollowers' ? 'active' : ''; ?>" href="layout.php?page=provider_CompanyFollowers">Company Profile </a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['provider_CompanyPuplicProfile']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>Location</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'provider_CompanyPuplicProfile' ? 'active' : ''; ?>" href="layout.php?page=provider_CompanyPuplicProfile">Company Public Profile </a></li>
                    </ul>
                </li>







                <li class="dropdown <?php echo in_array($currentPage, ['profile', 'resetpass']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Security</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'profile' ? 'active' : ''; ?>" href="layout.php?page=profile">Profile</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'resetpass' ? 'active' : ''; ?>" href="layout.php?page=resetpass">Reset Password</a></li>
                    </ul>
                </li>
            <?php endif; ?>


            <!-- Seeker Section has done -->
           <?php if ($userRole == 'seeker'): ?>

                <li class="<?php echo $currentPage == 'dashboard' ? 'active' : ''; ?>">
                    <a href="layout.php?page=dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_my_profile', 'seeker_build_resume', 'seeker_profile']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="map"></i><span>User Profile</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_my_profile' ? 'active' : ''; ?>" href="layout.php?page=seeker_my_profile">Build Profile </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_build_resume' ? 'active' : ''; ?>" href="layout.php?page=seeker_build_resume">Build Resume </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_profile' ? 'active' : ''; ?>" href="layout.php?page=seeker_profile">Profile</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'deleteuser' ? 'active' : ''; ?>" href="layout.php?page=seeker_view_public_profile">View Public Profile</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_apply_jobs', 'seeker_applied_jobs']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Jobs </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_apply_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_apply_jobs">Available Jobs </a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_applied_jobs' ? 'active' : ''; ?>" href="layout.php?page=seeker_applied_jobs">Applied Jobs</a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_payment_history']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="check-square"></i><span>Payment Details </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_payment_history' ? 'active' : ''; ?>" href="layout.php?page=seeker_payment_history">Payment History </a></li>

                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_messages']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="check-square"></i><span>Messages </span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_messages' ? 'active' : ''; ?>" href="layout.php?page=seeker_messages">My Messages </a></li>

                    </ul>
                </li>

                <!-- <li class="dropdown <?php echo in_array($currentPage, ['empreport', 'monthlyreport', 'yearlyreport']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="settings"></i><span>Performance Reports</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'empreport' ? 'active' : ''; ?>" href="layout.php?page=empreport">Employee Preference</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'monthlyreport' ? 'active' : ''; ?>" href="layout.php?page=monthlyreport">Monthly Report</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'yearlyreport' ? 'active' : ''; ?>" href="layout.php?page=yearlyreport">Yearly Report</a></li>
                    </ul>
                </li> -->

                <li class="dropdown <?php echo in_array($currentPage, ['seeker_followings']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="bell"></i><span>Followings</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'seeker_followings' ? 'active' : ''; ?>" href="layout.php?page=seeker_followings">My Followings</a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo in_array($currentPage, ['profile', 'resetpass']) ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Security</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php echo $currentPage == 'profile' ? 'active' : ''; ?>" href="layout.php?page=profile">Profile</a></li>
                        <li><a class="nav-link <?php echo $currentPage == 'resetpass' ? 'active' : ''; ?>" href="layout.php?page=resetpass">Reset Password</a></li>
                    </ul>
                </li>
            <?php endif; ?>

        </ul>
    </aside>
</div>