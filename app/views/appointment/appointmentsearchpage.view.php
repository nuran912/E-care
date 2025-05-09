<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment Search Result Page</title>

    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/appointmentsearchpage.css">
</head>

<body>

<div class="maincontent">  <h5>
    <span style="--i:1">Welcome</span> 
    <span style="--i:2">To</span> 
    <span style="--i:3">ECARE-UNION</span> 
    <span style="--i:4">Digital</span> 
    <span style="--i:5">Platform!</span>
  </h5>
    <h6>We are delighted to assist you in booking your appointments with our esteemed medical professionals.</h6>
    </div >
    <div class="searchform">
        
        <h2>Book Your Appointment</h2>
        <form id="search-form" action="" method="GET">
            <div class="form-group">
                <label for="doctor-name">Doctor Name:</label>
                <input type="text" <?php echo (empty($nameQuery) ? "" :  "value=\"$nameQuery\"") ?> name="doctor" id="" placeholder=" Enter doctor name">
            </div>
            <!-- <div class="form-group">
                <label for="doctor">Doctor:</label>
                <select id="doctor" name="doctor" <?php echo (empty($nameQuery) ? "" :  "value=\"$nameQuery\"") ?>>
                    <option value="" disabled selected>--Select Doctor--</option>
                    <?php if (!empty($doctorNames)) : ?>
                    <?php foreach ($doctorNames as $doctor): ?>
                        <option value="<?php echo $doctor['id']; ?>" <?php echo $nameQuery == $doctor['id'] ? 'selected' : ''; ?>>
                            <?php echo $doctor['name']; ?>
                        </option>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <option value="" disabled>No doctors available</option>
                    <?php endif; ?>
                </select>
                </select>
            </div> -->
            <?php if (!isset($_SESSION['USER']) || $_SESSION['USER'] === null || $_SESSION['USER']->role !== 'reception_clerk'): ?>
            <div class="form-group">
                <label for="hospital">Hospital:</label>
                <select id="hospital" name="hospital" <?php echo (empty($hospitalQuery) ? "" :  "value=\"$hospitalQuery\"") ?>>
                    <option value="" disabled selected>--Select Hospital--</option>
                    <?php foreach ($hospitals as $hospital): ?>
                        <option value="<?php echo $hospital['id']; ?>" <?php echo $hospitalQuery == $hospital['id'] ? 'selected' : ''; ?>>
                            <?php echo $hospital['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['USER']) && $_SESSION['USER'] !== null && $_SESSION['USER']->role === 'reception_clerk'): ?>
            
            <div class="form-group">
                <label for="hospital">Hospital:</label>
                <select id="hospital" name="hospital">
                    <option value="<?php echo $data['clerkDetails'][0]['hospital_id']; ?>" selected><?php echo $data['clerkDetails'][0]['name']; ?></option>
                </select>
            </div>
            <?php endif; ?>


            <div class="form-group">
                <label for="specialization">Specialization:</label>
                <select id="specialization" name="specialization" <?php echo (empty($specializationQuery) ? "" :  "value=\"$specializationQuery\"") ?>>

                    <option value="" disabled selected>--Select Specialization--</option>

                    <?php foreach ($specializations as $specialization): ?>

                        <option value="<?php echo $specialization; ?>" <?php echo !strcasecmp($specializationQuery, $specialization) ? 'selected' : ''; ?>>

                            <?php echo $specialization; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" <?php echo (empty($dateQuery) ? "" :  "value=\"$dateQuery\"") ?> name="date" min="<?php echo date('Y-m-d')?>">
            </div>

            <div class="button-container">
                <button type="submit" name="submit">Search</button>
                <button type="submit" name="submit" value="reset">Clear</button>
            </div>

        </form>
    </div>

    <?php if ($error): ?>
        <div class="error">Please enter at least one search criteria.</div>
    <?php elseif ($doctorResults !== null): ?>


        <div class="results">
            <h2><?php echo empty($doctorResults) ? "No" : $totalResults ?> Doctor(s) found!</h2>
            <div class="card-list">

                <?php if (($doctorResults) && is_array($doctorResults)): ?>
                    <?php foreach ($doctorResults as $doc) : ?>
                        <?php $user_id=$doc->user_id;
                        
                        $user=new User();
                        $profilepic=$user->getProfilePic($user_id);
                    
                        ?>
                        <div class="card">
                            <?php if(!empty($profilepic[0]['profile_pic'])): ?>
                            <img class="profimg " src="<?php echo ROOT; ?>/assets/profile_pictures/<?php echo $user_id ?>/<?php echo $profilepic[0]['profile_pic']?>" alt="Doctor's Profile Picture">
                            <?php else: ?>
                            <img class="profimg" src="<?php echo ROOT; ?>/assets/img/profilepic-img/profilepic.svg" alt="Default Profile Picture">
                            
                            <?php endif; ?>
                            
                            <h3><?php echo $doc->name ?></h3>
                            <p><?php echo is_array($doc->specialization) ? implode(", ", $doc->specialization) : $doc->specialization; ?></p>
                            <?php
                            $queryArray = array(
                                'doctor_id' => $doc->id,
                            );
                            if ($hospitalQuery) {
                                $queryArray['hospital_id'] = $hospitalQuery;
                            }
                            if ($dateQuery) {
                                $queryArray['date'] = $dateQuery;
                              }
                            ?>


                            <a href="<?php echo ROOT;  ?>/DoctorAvailableTimes?<?php echo http_build_query($queryArray); ?>">
                                <button>Channel Now</button>
                            </a>
                            <a href="<?php echo ROOT; ?>/DoctorProfilecard?id=<?= $doc->id ?>">
                                <button>View Profile</button>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="no-results">No results matched.</div>
                <?php endif; ?>

            </div>
            <?php if ($totalPages > 1): ?>
    <div class="pagination">

        <!-- Previous Button -->
        <?php
        $baseParams = $_GET;
        if ($currentPage > 1):
            $baseParams['page'] = $currentPage - 1;
            ?>
            <a href="?<?= http_build_query($baseParams); ?>" class="prev-btn">⟨ Prev</a>
        <?php else: ?>
            <span class="disabled prev-btn">⟨ Prev</span>
        <?php endif; ?>

        <!-- Page Numbers -->
        <div class="page-numbers">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php
                $baseParams['page'] = $i;
                $isActive = ($i == $currentPage) ? 'active-page' : '';
                ?>
                <a href="?<?= http_build_query($baseParams); ?>" class="<?= $isActive ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>

        <!-- Next Button -->
        <?php
        if ($currentPage < $totalPages):
            $baseParams['page'] = $currentPage + 1;
            ?>
            <a href="?<?= http_build_query($baseParams); ?>" class="next-btn">Next ⟩</a>
        <?php else: ?>
            <span class="disabled next-btn">Next ⟩</span>
        <?php endif; ?>

    </div>
<?php endif; ?>


        </div>
    <?php endif; ?>
</body>

</html>