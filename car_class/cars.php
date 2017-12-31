	

    <div class="card-container">
        <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>">
        <div class="card">
            <div class="front">
                <div class="cover">
					<img  src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" style='height: 100%; width: 100%;'>
				</div>
				<div class="content">
                    <div class="main">
                        <h3 class="name"><?php echo htmlentities($result->VehiclesTitle); ?></h3>
                       
                        <div class="first float_left">
                        	<span class="icon_mileage"></span><?php echo htmlentities($result->Vmilage); ?>&nbsp;km
                        </div>
                        <div class="first">
                        	<span class="icon_power"></span><?php echo htmlentities($result->top_speed); ?>&nbsp;km/h
                        </div>
                        <div class="second float_left">
                        	<span class="icon_fuel"></span><?php echo htmlentities($result->FuelType);?>
                        </div>
                        
                        <div class="second">
                        	<span class="icon_gearbox"></span><?php echo htmlentities($result->Vgearbox); ?>
                        </div>
                    </div>
                    <div class="price">
                    	Ksh.<?php echo htmlentities($result->PricePerDay); ?> Per Day
                    </div> 
                </div>
            </div> <!-- end front panel -->
            <div class="back">
                <p>
                	<label class="title">Type</label>
                	<span class="value"><?php echo $row['car_type'] == 'new' ? 'New car' : 'Used car'?></span>
                </p>
                <p>
                	<label class="title">Make</label>
                	<span class="value"><?php echo stripcslashes($result->BrandName) ?></span>
                </p>
                <p>
                	<label class="title">Model</label>
                	<span class="value"><?php echo stripcslashes($result->VehiclesTitle) ?></span>
                </p>
                 <p>
                	<label class="title">Year</label>
                	<span class="value"><?php echo stripcslashes($result->ModelYear) ?></span>
                </p>
                <p>
                	<label class="title">Power</label>
                	<span class="value"><?php echo stripcslashes($result->Vpower) ?> hp</span>
                </p>
                <p>
                	<label class="title">Mileage</label>
                	<span class="value"><?php echo stripcslashes($result->Vmilage) ?>Km</span>
                </p>
                <p>
                	<label class="title">Color</label>
                	<span class="value"><?php echo stripcslashes($result->Vcolor) ?></span>
                </p>
                <p>
                	<label class="title">Doors</label>
                	<span class="value"><?php echo stripcslashes($result->numDoors) ?></span>
                </p>
                <p>
                	<label class="title">Gearbox</label>
                	<span class="value"><?php echo stripcslashes($result->Vgearbox) ?></span>
                </p>
                <p>
                	<label class="title">Number of seats</label>
                	<span class="value"><?php echo stripcslashes($result->SeatingCapacity) ?></span>
                </p>
                <p>
                	<label class="title">Vehicle Type</label>
                	<span class="value"><?php echo stripcslashes($result->Vtype) ?></span>
                </p>
                
                
            </div> <!-- end back panel -->
        </div> <!-- end card -->
        </a>
    </div> <!-- end card-container -->