@extends('website.layout.structure')

@section('content')
<body class="bg-light">

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow p-4 border-0 rounded-4">

                <!-- Branding -->
                <div class="text-center mb-4">
                    <img src="{{ asset('website/img/logo.png') }}" alt="Photography By Monali" style="width:90px; border-radius:12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <h5 class="mt-3 font-dancing-script text-primary" style="font-size: 28px;">Photography By Monali</h5>
                    <p class="text-muted small">Capture Your Precious Moments</p>
                </div>

                @php 
                    $pre_cat = request()->get('category_id');
                    $pre_theme = request()->get('catalogue_id');
                    $pre_pack = request()->get('package_id');
                    
                    // Identify Category IDs for filtering add-ons
                    $maternity_id = 0;
                    $newborn_id = 0;
                    $family_id = 0;
                    $kids_id = 0;
                    if(isset($cate_arr)){
                        foreach($cate_arr as $c) {
                            if(stripos($c->category_name, 'Maternity') !== false) $maternity_id = $c->category_id;
                            if(stripos($c->category_name, 'New Born') !== false) $newborn_id = $c->category_id;
                            if(stripos($c->category_name, 'family') !== false) $family_id = $c->category_id;
                            if(stripos($c->category_name, 'Kids') !== false) $kids_id = $c->category_id;
                        }
                    }
                @endphp
                
                <form method="post" id="bookingForm" onsubmit="return validateForm()">
                    @csrf
                    <!-- 1. Category -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">1. Select Shoot Category</label>
                        <select name="category_id" id="category_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required style="font-size: 16px;">
                            <option value="">-- Choose Category --</option>
                            @isset($cate_arr)
                                @foreach($cate_arr as $cat)
                                    <option value="{{ $cat->category_id }}" {{ ($pre_cat == $cat->category_id) ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- 2. Package -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">2. Choose Package</label>
                        <select name="package_id" id="package_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required style="font-size: 16px;">
                            <option value="">-- Choose Package --</option>
                            @isset($pack_arr)
                                @foreach($pack_arr as $pack)
                                    <option value="{{ $pack->package_id }}" 
                                            data-cat="{{ $pack->category_id }}" 
                                            data-max="{{ $pack->max_catelogues }}"
                                            {{ ($pre_pack == $pack->package_id) ? 'selected' : '' }}
                                            style="display:none;">
                                        {{ $pack->package_name }} – ₹{{ $pack->price }} 
                                        (Max {{ $pack->max_catelogues }} Themes)
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- 3. Themes (Visual Selection) -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                             <label class="form-label fw-bold mb-0">3. Select Theme / Setup</label>
                             <span id="limit-msg" class="badge bg-primary rounded-pill"></span>
                        </div>
                        
                        <div id="theme-grid" class="row g-2" style="max-height: 400px; overflow-y: auto; padding: 10px; border-radius: 10px; background: #f8f9fa;">
                            @isset($catalogue_arr)
                                @foreach($catalogue_arr as $cat)
                                    <div class="col-6 col-sm-4 theme-card-wrapper" data-cat="{{ $cat->category_id }}" style="display:none;">
                                        <div class="theme-card position-relative {{ ($pre_theme == $cat->catalogue_id) ? 'selected' : '' }}" 
                                             onclick="toggleTheme(this, {{ $cat->catalogue_id }})">
                                            <img src="{{ asset('admin/images/catalogues/' . $cat->image) }}" class="img-fluid rounded" style="height: 120px; width: 100%; object-fit: cover;">
                                            <div class="theme-name p-2 small text-center fw-bold">{{ $cat->catalogue_name }}</div>
                                            <div class="selection-check">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>
                                            <input type="checkbox" name="catalogue_id[]" value="{{ $cat->catalogue_id }}" 
                                                   id="theme_{{ $cat->catalogue_id }}" class="d-none" 
                                                   {{ ($pre_theme == $cat->catalogue_id) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                        <div id="no-themes-msg" class="text-center py-3 text-muted" style="display:none;">
                            Please select a category first to see available themes.
                        </div>
                    </div>

                    <!-- 4. Date -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">4. Preferred Date</label>
                        <input type="date" name="appointment_date" class="form-control form-control-lg shadow-sm border-0 bg-light" required min="{{ date('Y-m-d', strtotime('+7 days')) }}">
                    </div>

                    <!-- 5. Time Slot -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">5. Choose Time Slot</label>
                        <select name="slot_id" id="slot_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required style="font-size: 16px;">
                            <option value="">-- Choose Slot --</option>
                            @isset($slot_arr)
                                @foreach($slot_arr as $slot)
                                    <option value="{{ $slot->slot_id }}">{{ $slot->slot_name }} ({{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }})</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- 6. Shoot Location -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">6. Where will we shoot?</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <select name="venue_type" id="venue_type" class="form-select form-select-lg shadow-sm border-0 bg-light" required onchange="toggleVenueAddress()">
                                    <option value="studio">Our Studio (Included)</option>
                                    <option value="home">Home Visit (+ ₹3,500)</option>
                                    <option value="outdoor">Outdoor Location (+ ₹3,500)</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="venue_address_container" style="display:none;">
                                <label class="form-label small fw-bold text-muted">VENUE ADDRESS / LOCATION DETAILS</label>
                                <textarea name="venue_address" id="venue_address" class="form-control shadow-sm border-0 bg-light" rows="2" placeholder="Street, Area, Landmark..."></textarea>
                                <div class="mt-2 small text-primary p-2 bg-primary-subtle rounded-3">
                                    <i class="bi bi-info-circle me-1"></i> For home visits, we bring a portable studio setup including backgrounds, lights, and props.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Add-on Services (Optional) -->
                    <div class="mb-4">
                        <label class="form-label fw-bold" id="addon-label">7. Add-on Services (Optional)</label>
                        <div class="row g-2" id="addon-container">
                            
                            <!-- Maternity & Specific -->
                            <div class="col-6 addon-wrapper" data-cat="{{ $maternity_id }}">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Makeup & hair:2000" id="addon_makeup">
                                        <label class="form-check-label small fw-bold" for="addon_makeup">Makeup & hair</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹2,000</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="{{ $maternity_id }}">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Extra Gown:3000" id="addon_gown">
                                        <label class="form-check-label small fw-bold" for="addon_gown">Extra Gown</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹3,000</p>
                                </div>
                            </div>

                            <!-- Newborn Specific -->
                            <div class="col-6 addon-wrapper" data-cat="{{ $newborn_id }}">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Extra Props:1000" id="addon_props">
                                        <label class="form-check-label small fw-bold" for="addon_props">Extra Props</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹1,000</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="{{ $newborn_id }}">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Additional Setup:3000" id="addon_setup">
                                        <label class="form-check-label small fw-bold" for="addon_setup">Additional Setup</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹3,000</p>
                                </div>
                            </div>

                            <!-- General for all -->
                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="BTS Reel:2000" id="addon_reel">
                                        <label class="form-check-label small fw-bold" for="addon_reel">BTS Reel / Behind Scene</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹2,000</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Extra Edited Photos:250" id="addon_photos">
                                        <label class="form-check-label small fw-bold" for="addon_photos">Extra Edited Photos</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹250</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Additional Outfit:2000" id="addon_outfit">
                                        <label class="form-check-label small fw-bold" for="addon_outfit">Additional Outfit</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹2,000</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Raw data in mini session:2000" id="addon_raw">
                                        <label class="form-check-label small fw-bold" for="addon_raw">Raw Data (Mini)</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹2,000</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Additional family member:1000" id="addon_family">
                                        <label class="form-check-label small fw-bold" for="addon_family">Add Family Member</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹1,000</p>
                                </div>
                            </div>

                            <!-- NEW PREMIUM ADD-ONS -->
                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Premium Photo Album:4000" id="addon_album">
                                        <label class="form-check-label small fw-bold" for="addon_album">Premium Photo Album</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹4,000</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Luxury Photo Frame:1800" id="addon_frame">
                                        <label class="form-check-label small fw-bold" for="addon_frame">Luxury Photo Frame</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹1,800</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Cinematic Highlight Reel:5000" id="addon_cinereel">
                                        <label class="form-check-label small fw-bold" for="addon_cinereel">Cinematic Highlight Reel</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹5,000</p>
                                </div>
                            </div>

                            <div class="col-6 addon-wrapper" data-cat="all">
                                <div class="p-3 border rounded-3 bg-white h-100 addon-card" onclick="toggleAddon(this, event)">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]" value="Outdoor Venue / Location:3500" id="addon_venue">
                                        <label class="form-check-label small fw-bold" for="addon_venue">Outdoor Venue / Home Visit</label>
                                    </div>
                                    <p class="text-primary small mb-0 mt-1">₹3,500</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 7. Discount / Coupon -->
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">HAVE A COUPON?</label>
                        <div class="input-group">
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control form-control-sm shadow-sm border-0" placeholder="Enter coupon code">
                            <button class="btn btn-outline-primary btn-sm px-4" type="button" onclick="applyCoupon()">Apply</button>
                        </div>
                        <div id="coupon-msg" class="small mt-1"></div>
                        <input type="hidden" name="applied_coupon_id" id="applied_coupon_id">
                    </div>

                    <!-- 8. Terms and Conditions -->
                    <div class="mb-4 bg-light p-3 rounded-3 border">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms_agree" required>
                            <label class="form-check-label small text-muted" for="terms_agree">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" class="text-primary fw-bold text-decoration-none">Terms and Conditions</a> of Photography By Monali.
                            </label>
                        </div>
                    </div>

                    <button type="submit" name="book" class="btn btn-primary w-100 py-3 fw-bold shadow-sm rounded-pill mb-3">
                        <i class="bi bi-calendar-heart me-2"></i> Request Appointment
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ url('mybooking') }}" class="text-muted small text-decoration-none">View My Recent Requests</a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<style>
.theme-card {
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 10px;
    background: #fff;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}
.theme-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
.theme-card.selected { border-color: #d81b60; background: #fffafb; }
.selection-check {
    position: absolute;
    top: 5px;
    right: 5px;
    color: #d81b60;
    font-size: 20px;
    display: none;
    background: white;
    border-radius: 50%;
    line-height: 1;
}
.theme-card.selected .selection-check { display: block; }
#theme-grid::-webkit-scrollbar { width: 6px; }
#theme-grid::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
.addon-card {
    cursor: pointer;
    transition: 0.3s;
}
.addon-card:hover { border-color: #d81b60; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.addon-card.selected { border-color: #d81b60 !important; }
</style>

<script>
var maxThemes = 1;

function filterOptions() {
    var catId = document.getElementById('category_id').value;
    
    // 1. Filter Packages
    var pkgSelect = document.getElementById('package_id');
    var packages = pkgSelect.options;
    var anyPkgVisible = false;
    for (var i = 0; i < packages.length; i++) {
        if (packages[i].getAttribute('data-cat') == catId || packages[i].value == "") {
            packages[i].style.display = 'block';
            anyPkgVisible = true;
        } else {
            packages[i].style.display = 'none';
        }
    }
    if(pkgSelect.selectedOptions[0] && pkgSelect.selectedOptions[0].style.display == 'none') {
        pkgSelect.value = "";
    }

    // 2. Filter Theme Cards
    var themeWrappers = document.querySelectorAll('.theme-card-wrapper');
    var anyThemeVisible = false;
    themeWrappers.forEach(function(wrapper) {
        if (wrapper.getAttribute('data-cat') == catId) {
            wrapper.style.display = 'block';
            anyThemeVisible = true;
        } else {
            wrapper.style.display = 'none';
            // Deselect if hidden
            var card = wrapper.querySelector('.theme-card');
            if(card.classList.contains('selected')) {
                card.classList.remove('selected');
                wrapper.querySelector('input').checked = false;
            }
        }
    });

    document.getElementById('theme-grid').style.display = anyThemeVisible ? 'flex' : 'none';
    document.getElementById('no-themes-msg').style.display = anyThemeVisible ? 'none' : 'block';
    
    // 3. Filter Add-on Services
    var addonWrappers = document.querySelectorAll('.addon-wrapper');
    var anyAddonVisible = false;
    addonWrappers.forEach(function(wrapper) {
        var addonCat = wrapper.getAttribute('data-cat');
        if (addonCat === "all" || addonCat === catId) {
            wrapper.style.display = 'block';
            anyAddonVisible = true;
        } else {
            wrapper.style.display = 'none';
            // Deselect hidden add-ons
            var card = wrapper.querySelector('.addon-card');
            var checkbox = wrapper.querySelector('input');
            if(checkbox.checked) {
                card.classList.remove('selected');
                card.classList.replace('bg-primary-subtle', 'bg-white');
                checkbox.checked = false;
            }
        }
    });

    document.getElementById('addon-container').style.display = anyAddonVisible ? 'flex' : 'none';
    document.getElementById('addon-label').style.display = anyAddonVisible ? 'block' : 'none';

    updateLimit();
}

function updateLimit() {
    var pkgSelect = document.getElementById('package_id');
    var selectedPkg = pkgSelect.selectedOptions[0];
    
    if(selectedPkg && selectedPkg.value != "") {
        maxThemes = parseInt(selectedPkg.getAttribute('data-max')) || 1;
        document.getElementById('limit-msg').innerHTML = "Max " + maxThemes + " Themes";
    } else {
        maxThemes = 1;
        document.getElementById('limit-msg').innerHTML = "";
    }
}

function toggleTheme(card, id) {
    var checkbox = document.getElementById('theme_' + id);
    var selectedCount = document.querySelectorAll('.theme-card.selected').length;

    if (!card.classList.contains('selected')) {
        if (selectedCount >= maxThemes) {
            Swal.fire({
                title: 'Limit Reached',
                text: "Your selected package only allows a maximum of " + maxThemes + " themes.",
                icon: 'warning',
                confirmButtonColor: '#E7B894'
            });
            return;
        }
        card.classList.add('selected');
        checkbox.checked = true;
    } else {
        card.classList.remove('selected');
        checkbox.checked = false;
    }
}

document.getElementById('category_id').addEventListener('change', filterOptions);
document.getElementById('package_id').addEventListener('change', updateLimit);

function validateForm() {
    var selectedCount = document.querySelectorAll('.theme-card.selected').length;
    if(selectedCount == 0) {
        Swal.fire({
            title: 'Selection Required',
            text: "Please select at least one theme.",
            icon: 'info',
            confirmButtonColor: '#E7B894'
        });
        return false;
    }

    var slot = document.getElementById('slot_id');
    if(slot.value == "") {
        Swal.fire({
            title: 'Time Slot',
            text: "Please select a time slot.",
            icon: 'info',
            confirmButtonColor: '#E7B894'
        });
        return false;
    }

    var terms = document.getElementById('terms_agree');
    if(!terms.checked) {
        Swal.fire({
            title: 'Terms of Service',
            text: "Please agree to the Terms and Conditions to proceed.",
            icon: 'warning',
            confirmButtonColor: '#E7B894'
        });
        return false;
    }
    return true;
}

function applyCoupon() {
    var code = document.getElementById('coupon_code').value;
    if(code == "") return;
    
    fetch('{{ url("check_coupon") }}?code=' + code)
        .then(response => response.json())
        .then(data => {
            var msg = document.getElementById('coupon-msg');
            if(data.status == 'success') {
                msg.innerHTML = "Coupon Applied! " + (data.data.discount_type == 'percentage' ? data.data.discount_value + '%' : '₹' + data.data.discount_value) + " Discount";
                msg.className = "small mt-1 text-success fw-bold";
                document.getElementById('applied_coupon_id').value = data.data.coupon_id;
            } else {
                msg.innerHTML = data.message;
                msg.className = "small mt-1 text-danger fw-bold";
                document.getElementById('applied_coupon_id').value = "";
            }
        });
}

function toggleAddon(card, event) {
    var checkbox = card.querySelector('input[type="checkbox"]');
    if (event && (event.target.tagName === 'INPUT' || event.target.tagName === 'LABEL')) {
        setTimeout(() => {
            if(checkbox.checked) {
                card.classList.add('selected');
                card.classList.replace('bg-white', 'bg-primary-subtle');
            } else {
                card.classList.remove('selected');
                card.classList.replace('bg-primary-subtle', 'bg-white');
            }
        }, 10);
        return;
    }
    checkbox.checked = !checkbox.checked;
    if(checkbox.checked) {
        card.classList.add('selected');
        card.classList.replace('bg-white', 'bg-primary-subtle');
    } else {
        card.classList.remove('selected');
        card.classList.replace('bg-primary-subtle', 'bg-white');
    }
}

function toggleVenueAddress() {
    var type = document.getElementById('venue_type').value;
    var container = document.getElementById('venue_address_container');
    container.style.display = (type == 'home' || type == 'outdoor') ? 'block' : 'none';
}

window.onload = function() {
    filterOptions();
    updateLimit();
    toggleVenueAddress();
};
</script>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header bg-primary text-white rounded-top-4 py-3">
                <h5 class="modal-title fw-bold" id="termsModalLabel"><i class="bi bi-shield-check me-2"></i> Booking Policy & Terms</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="max-height: 480px; overflow-y: auto;">
                <div class="mb-4">
                    <h6 class="fw-bold text-primary border-bottom pb-2 d-flex align-items-center">
                        <i class="bi bi-calendar-check me-2"></i> 1. Booking Procedure & Terms
                    </h6>
                    <ul class="list-unstyled small text-muted mt-2 ps-3">
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Booking requires an advance payment of <b>₹2,000</b> to secure your slot.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Deposit is non-refundable but can be reused for a future session.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>No rescheduling</b> allowed for weekend shoots once confirmed.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Storage responsibility for your photos ends <b>3 months</b> post-shoot.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Ideal timing for pregnancy sessions: <b>28–32 weeks</b> for best results.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Any rescheduling needs at least <b>48-hour prior notice</b>.</li>
                    </ul>
                </div>
                <div class="mb-0">
                    <h6 class="fw-bold text-primary border-bottom pb-2 d-flex align-items-center">
                        <i class="bi bi-box-seam me-2"></i> 2. Deliverables & Terms
                    </h6>
                    <ul class="list-unstyled small text-muted mt-2 ps-3">
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Timeline:</b> Raw photos within 3 days; Edited photos within a week.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Albums:</b> Photobook & album delivery takes 30–35 days post-selection.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Delivery:</b> All high-resolution photos will be shared via Google Drive link.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Logo:</b> Edited photos include studio logo unless explicitly opted out.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Privacy:</b> Private sessions (no social media posting) incur a <b>25% extra charge</b>.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Time:</b> Late arrival may shorten your session duration to respect further appointments.</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light rounded-bottom-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
