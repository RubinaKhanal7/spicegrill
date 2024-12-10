@extends('layouts.master')
@php
    
    $sitesetting = App\Models\SiteSetting::first();
    
@endphp


@section('content')

<style>
    .button-group {
    display: flex;
    gap: 10px; /* Adjust the gap between buttons as needed */
    justify-content: center; /* Center the buttons */
    align-items: center;
  }

  .u-btn {
    padding: 10px 20px; /* Adjust the padding as needed */
    text-decoration: none;
    color: white; /* Adjust the text color as needed */
    border-radius: 4px; /* Adjust the border-radius as needed */
    transition: background-color 0.3s ease; /* Add a transition effect */
  }

  .u-btn:hover {
    background-color: #333; /* Adjust the hover background color as needed */
  }

/* Modal styles */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  max-width: 500px;
  width: 90%;
  color: black;
}
@media (max-width: 768px) {
        .container {
            padding: 0 10px;
        }

        .menu_head {
            font-size: 2em;
        }

        .itemNameWrap {
            flex-direction: column;
            align-items: flex-start;
        }

        .itemMiddle {
            display: none;
        }

        .itemName, .itemPrice {
            margin-bottom: 5px;
        }

        .quantityControl {
            justify-content: flex-start;
        }

        #checkoutButton {
            display: block;
            width: 100%;
            text-align: center;
            margin-left: 0;
        }
    }
</style>

    <section class="u-clearfix u-section-1 " id="sec-703b">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1 ">
            <div class="u-layout ">
                <div class="u-layout-row">
                    <div
                        class="u-align-center-md u-align-center-sm u-container-style u-layout-cell u-palette-1-base u-right-cell u-size-21 u-layout-cell-1 ">
                        <div class="u-container-layout u-valign-middle u-container-layout-1 ">
                            <img src="{{ url('uploads/sitesetting/' . $sitesetting->side_logo ?? '') }}" alt="" class="u-image u-image-contain u-image-default u-image-1">
                            <h2 class="u-align-center-lg u-align-center-xl u-align-center-xs u-subtitle u-text u-text-1 text-center">{{ $sitesetting->department_name }}</h2>
                            <h1 class="u-align-center-lg u-align-center-xl u-align-center-xs u-custom-font u-text u-title u-text-2">{{ $sitesetting->office_name }}</h1>
                            
                           <!-- Index page -->
                            <div class="button-group">
                                <a href="#" class="u-btn u-button-style u-palette-2-base u-btn-1" data-toggle="modal" data-target="#bookTableModal">Book Now</a>
                                <a href="{{ route('Viewmenu') }}" class="u-btn u-button-style u-palette-2-base u-btn-1">Order Now</a>
                            </div>
                            
                           <!-- Book Table Modal -->
                            <div class="modal fade" id="bookTableModal" tabindex="-1" aria-labelledby="bookTableModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #243b55;">
                                            <h5 class="modal-title text-white" id="bookTableModalLabel"><i class="fas fa-utensils mr-2"></i> Book a Table</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="successMessage" class="alert alert-success d-none"></div>
                                            <div id="errorMessage" class="alert alert-danger d-none"></div>
                                            <form id="booktableForm" action="{{ route('BookTables.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" for="fullname">Fullname</label>
                                                    <input class="form-control" id="fullname" name="fullname" type="text" required/>
                                                </div>
                                                <div class="row mb-3">
                                                <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="phone_number">Phone Number</label>
                                                    <input class="form-control" id="phone_number" name="phone_no" type="tel" required/>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="no_of_people">Number Of People</label>
                                                    <input class="form-control" id="no_of_people" name="no_of_people" type="number" min="1" required/>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="booking_start_time">Start Time</label>
                                                            <input class="form-control" id="booking_start_time" name="booking_start_time" type="datetime-local" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="booking_end_time">End Time (Optional)</label>
                                                            <input class="form-control" id="booking_end_time" name="booking_end_time" type="datetime-local">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="table_number">Table Number</label>
                                                    <select class="form-control" id="table_number" name="table_number" required>
                                                        <option value="">Select a table</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn-primary w-100" type="submit" style="background-color: #243b55; border-color: #243b55;">Submit</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const form = document.getElementById('booktableForm');
                                    const successMessage = document.getElementById('successMessage');
                                    const errorMessage = document.getElementById('errorMessage');
                                    const startTimeInput = document.getElementById('booking_start_time');
                                    const tableSelect = document.getElementById('table_number');
                                    const noOfPeopleInput = document.getElementById('no_of_people');
                                
                                    form.addEventListener('submit', function(event) {
                                        event.preventDefault();
                                        var formData = new FormData(form);
                                
                                        fetch(form.action, {
                                            method: 'POST',
                                            body: formData,
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                'Accept': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                form.style.display = 'none';
                                                successMessage.textContent = data.message;
                                                successMessage.classList.remove('d-none');
                                                errorMessage.classList.add('d-none');
                                                
                                                // Update table status
                                                updateTableStatus(formData.get('table_number'));
                                                
                                                setTimeout(() => {
                                                    $('#bookTableModal').modal('hide');
                                                    window.location.href = '/'; 
                                                }, 1000);
                                            } else {
                                                throw new Error(data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error during form submission:', error);
                                            errorMessage.textContent = error.message;
                                            errorMessage.classList.remove('d-none');
                                            successMessage.classList.add('d-none');
                                            
                                            if (error.message.includes('alternative table')) {
                                                updateAvailableTables(error.alternativeTables);
                                            }
                                        });
                                    });
                                
                                    function updateTableStatus(tableId) {
                                        fetch(`/admin/update-table-status/${tableId}`, {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                'Accept': 'application/json'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                console.log('Table status updated successfully');
                                            } else {
                                                console.error('Failed to update table status');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error updating table status:', error);
                                        });
                                    }
                                
                                    function updateAvailableTables(alternativeTables = null) {
                                        console.log('Updating available tables');
                                        var startTime = startTimeInput.value;
                                        var noOfPeople = noOfPeopleInput.value;
                                        console.log('Start time:', startTime, 'Number of people:', noOfPeople);
                                
                                        if (startTime && noOfPeople) {
                                            if (alternativeTables) {
                                                console.log('Using alternative tables:', alternativeTables);
                                                populateTableSelect(alternativeTables);
                                            } else {
                                                console.log('Fetching available tables');
                                                fetch(`/get-available-tables?booking_start_time=${encodeURIComponent(startTime)}&no_of_people=${encodeURIComponent(noOfPeople)}`, {
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                        'Accept': 'application/json'
                                                    }
                                                })
                                                .then(response => {
                                                    if (!response.ok) {
                                                        throw new Error('Network response was not ok');
                                                    }
                                                    return response.json();
                                                })
                                                .then(tables => {
                                                    console.log('Received tables:', tables);
                                                    populateTableSelect(tables);
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching tables:', error);
                                                    if (error.response) {
                                                        console.error('Response data:', error.response.data);
                                                        console.error('Response status:', error.response.status);
                                                    }
                                                    tableSelect.innerHTML = '<option value="">Error loading tables</option>';
                                                });
                                            }
                                        } else {
                                            console.log('Start time or number of people not set');
                                            tableSelect.innerHTML = '<option value="">Select start time and number of people first</option>';
                                        }
                                    }
                                
                                    function populateTableSelect(tables) {
                                        console.log('Populating table select with:', tables);
                                        tableSelect.innerHTML = '<option value="">Select a table</option>';
                                        if (tables.length === 0) {
                                            tableSelect.innerHTML += '<option value="" disabled>No tables available</option>';
                                        } else {
                                            tables.forEach(table => {
                                                var option = document.createElement('option');
                                                option.value = table.id;
                                                option.textContent = `Table ${table.table_number}`;
                                                tableSelect.appendChild(option);
                                            });
                                        }
                                    }
                                
                                    startTimeInput.addEventListener('change', () => updateAvailableTables());
                                    noOfPeopleInput.addEventListener('change', () => updateAvailableTables());
                                
                                    $('#bookTableModal').on('hidden.bs.modal', function () {
                                        form.reset();
                                        form.style.display = 'block';
                                        successMessage.classList.add('d-none');
                                        errorMessage.classList.add('d-none');
                                        tableSelect.innerHTML = '<option value="">Select a table</option>';
                                    });
                                });
                                </script>
                        </div>
                    </div>
                    {{-- <div class="container"> --}}
                    <div class="u-container-style u-image u-layout-cell u-left-cell u-size-39 u-image-2">
                        <div class="u-container-layout">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($coverimages as $key => $coverimage)
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $key }}" class=""
                                            aria-label="Slide {{ $key + 1 }}"></button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner">


                                    @foreach ($coverimages as $key => $coverimage)
                                        <div class="carousel-item">

                                            {{-- {{ route('post.render', ['slug' => $news->slug ?? '', 'id' => $news->id ?? '']) }} --}}
                                            <a href="#">
                                                <img src="{{ asset('uploads/coverimage/' . $coverimage->image) }}"
                                                    class="d-block w-100 cover_image" alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $coverimage->title }}</h5>

                                                </div>
                                            </a>

                                        </div>
                                    @endforeach

                                </div>


                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var carouselIndicators = document.querySelectorAll(
                "#carouselExampleIndicators .carousel-indicators button");
            var carouselItems = document.querySelectorAll(
                "#carouselExampleIndicators .carousel-inner .carousel-item");

            carouselIndicators[0].classList.add("active");
            carouselItems[0].classList.add("active");
        });
    </script>


    <section class="u-clearfix u-palette-2-base u-section-2" id="sec-bdab">
        <div class="container">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div
                                class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-left-cell u-size-12 u-size-30-md u-layout-cell-1">
                                <div
                                    class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-valign-top-lg u-valign-top-xl u-container-layout-1">
                                    <span class="u-icon u-icon-circle u-text-palette-1-base u-icon-1"><svg
                                            class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 512 512"
                                            style="">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-984f"></use>
                                        </svg><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px"
                                            id="svg-984f" style="enable-background:new 0 0 512 512;">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M468.467,125.688c-23.347-18.607-56.3-33.841-97.944-45.277c-80.091-21.994-170.408-24.368-205.522-24.368    C74.019,56.043,0,130.063,0,221.045v69.91c0,90.983,74.019,165.002,165.001,165.002c41.953,0,73.46-13.142,106.817-27.056    c34.496-14.389,70.165-29.267,120.331-29.267c66.086,0,119.851-53.766,119.851-119.851v-69.91    C512,177.034,497.353,148.71,468.467,125.688z M460.046,296.642c3.786,4.023,10.115,4.212,14.136,0.427    c6.782-6.386,12.748-13.501,17.818-21.162v3.876c0,55.059-44.793,99.851-99.851,99.851c-54.17,0-91.718,15.662-128.03,30.808    c-31.457,13.121-61.169,25.515-99.118,25.515c-76.82,0-139.869-60.053-144.693-135.678c28.08,51.073,82.409,85.766,144.693,85.766    c41.953,0,73.46-13.142,106.817-27.056c34.496-14.389,70.165-29.267,120.331-29.267c3.727,0,7.492-0.176,11.192-0.522    c5.499-0.515,9.539-5.39,9.024-10.889c-0.515-5.498-5.396-9.537-10.889-9.023c-3.083,0.288-6.22,0.435-9.327,0.435    c-54.17,0-91.718,15.662-128.03,30.808c-31.457,13.121-61.169,25.515-99.118,25.515c-79.954,0-145.001-65.047-145.001-145    c0-79.954,65.047-145.002,145.001-145.002c34.303,0,122.481,2.305,200.226,23.654C449.347,122.799,492,159.867,492,209.873    c0,27.295-11.492,53.769-31.528,72.633C456.451,286.292,456.26,292.621,460.046,296.642z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M451.823,303.025c-2.352-4.997-8.311-7.142-13.306-4.79c-0.072,0.033-0.167,0.08-0.238,0.115    c-4.939,2.47-6.941,8.477-4.472,13.416c1.752,3.504,5.284,5.53,8.953,5.53c1.482,0,2.986-0.331,4.404-1.028    C452.067,313.875,454.154,307.978,451.823,303.025z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M237.188,98.862l-0.515-0.042c-5.514-0.43-10.325,3.668-10.764,9.174c-0.439,5.505,3.668,10.324,9.173,10.764l0.511,0.04    c0.271,0.022,0.54,0.033,0.808,0.033c5.161,0,9.538-3.97,9.958-9.203C246.799,104.122,242.693,99.303,237.188,98.862z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M465.756,182.933c-9.919-19.604-31.989-36.546-65.599-50.354c-27.195-11.173-56.936-18.231-77.097-22.186    c-12.083-2.369-24.745-4.485-37.635-6.287c-5.467-0.772-10.523,3.048-11.289,8.519c-0.765,5.47,3.049,10.523,8.519,11.288    c12.53,1.752,24.829,3.807,36.556,6.107c68.69,13.471,115.599,36.048,128.699,61.94c2.752,5.441,4.09,11.3,4.09,17.912    c0,33.001-26.849,59.85-59.851,59.85c-33.368,0-65.771,5.453-99.061,16.672c-14.338,4.833-28.26,10.61-41.723,16.198    c-8.905,3.695-18.113,7.517-27.253,10.98c-23.065,8.742-40.744,12.472-59.111,12.472c-57.898,0-105.002-47.103-105.002-105    c0-57.898,47.104-105.002,105.002-105.002c11.295,0,22.762,0.214,34.08,0.636c1.921,0.071,3.844,0.148,5.768,0.233    c5.513,0.25,10.188-4.032,10.431-9.55c0.244-5.517-4.032-10.188-9.549-10.431c-1.97-0.087-3.94-0.166-5.906-0.239    C188.26,96.26,176.543,96.042,165,96.042c-68.926,0-125.002,56.075-125.002,125.002c0,68.925,56.075,125,125.002,125    c20.935,0,40.733-4.118,66.199-13.77c9.431-3.574,18.785-7.456,27.832-11.211c13.153-5.458,26.754-11.103,40.444-15.717    c31.198-10.514,61.512-15.625,92.674-15.625c44.03,0.002,79.851-35.819,79.851-79.848    C472,200.051,469.957,191.239,465.756,182.933z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M174.578,135.82c-27.956,0-50.701,20.625-50.701,45.977s22.745,45.977,50.701,45.977    c27.957,0,50.701-20.625,50.701-45.977S202.535,135.82,174.578,135.82z M174.578,207.773c-16.929,0-30.701-11.653-30.701-25.977    c0-14.323,13.772-25.977,30.701-25.977s30.701,11.653,30.701,25.977C205.279,196.12,191.507,207.773,174.578,207.773z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg></span>
                                    <h3 class="u-text u-text-1">Meat</h3>
                                    <a href="{{ route('Product') }}" class="u-link u-link-1">view
                                        all <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div
                                class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-size-12 u-size-30-md u-layout-cell-2">
                                <div
                                    class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-valign-top-lg u-valign-top-xl u-container-layout-2">
                                    <span class="u-icon u-icon-circle u-text-palette-1-base u-icon-2"><svg
                                            class="u-svg-link" preserveAspectRatio="xMidYMin slice"
                                            viewBox="0 0 511.997 511.997" style="">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-2580"></use>
                                        </svg><svg class="u-svg-content" viewBox="0 0 511.997 511.997" x="0px"
                                            y="0px" id="svg-2580"
                                            style="enable-background:new 0 0 511.997 511.997;">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M510.646,261.469C468.003,185.134,397.9,138.456,315.733,129.806c-41.195-52.03-170.456-65.211-176.035-65.754     c-3.635-0.375-7.292,1.208-9.521,4.167c-2.24,2.938-2.792,6.833-1.458,10.281c12.673,32.896,25.656,70.313,29.092,85.621     c-23.473,10.741-43.99,22.163-57.217,31.681c-28.688-45.896-87.25-46.469-89.927-46.469C4.771,149.333,0,154.104,0,160     c0,61.802,21.542,92.823,35.948,106.667C21.542,280.51,0,311.531,0,373.333C0,379.229,4.771,384,10.667,384     c2.677,0,61.24-0.573,89.927-46.469c17.573,12.646,47.957,28.637,81.159,41.931c-7.337,11.867-11.086,30.742-11.086,57.871     c0,5.896,4.771,10.667,10.667,10.667c3.172,0,75.708-0.629,111.832-43.003c91.87-1.775,170.978-49.891,217.48-133.133     C512.448,268.635,512.448,264.698,510.646,261.469z M154.906,87.417c35.841,5.188,94.682,17.952,127.934,40.799     c-30.66,1.198-69.78,12.79-105.243,27.336C172.875,136.802,162.398,107.509,154.906,87.417z M192.25,426.052     c1.421-29.671,8.267-37.254,10.186-38.806c20.786,7.296,41.846,13.094,60.969,16.004     C240.266,419.531,208.723,424.598,192.25,426.052z M201.198,386.854l0.004-0.029c0.029,0.01,0.059,0.018,0.087,0.029     C201.229,386.846,201.262,386.863,201.198,386.854z M288,384c-62.333,0-164.25-51.177-183.125-70.49     c-2.021-2.073-4.781-3.208-7.625-3.208c-0.646,0-1.302,0.063-1.948,0.177c-3.49,0.646-6.438,3-7.844,6.26     c-14.396,33.385-48.25,42.5-65.844,44.99c3.333-66.844,34.969-84.708,36.594-85.573c3.51-1.802,5.677-5.438,5.729-9.385     c0.052-3.99-2.188-7.708-5.719-9.583c-1.427-0.76-33.25-18.5-36.604-85.521c17.583,2.573,51.562,11.823,65.844,44.927     c1.406,3.26,4.354,5.615,7.844,6.26c3.521,0.656,7.094-0.49,9.573-3.031c18.875-19.313,120.792-70.49,183.125-70.49     c84.219,0,157.167,42.677,201.042,117.333C445.167,341.323,372.219,384,288,384z">
                                                        </path>
                                                        <path
                                                            d="M320,266.666c0-49.083,19.365-79.146,19.563-79.448c3.229-4.917,1.875-11.521-3.021-14.771     c-4.896-3.229-11.5-1.906-14.75,2.969c-0.948,1.417-23.125,35.333-23.125,91.25c0,55.917,22.177,89.833,23.125,91.25     c2.052,3.083,5.438,4.75,8.885,4.75c2.031,0,4.083-0.583,5.906-1.792c4.906-3.271,6.229-9.885,2.958-14.792     C339.344,345.792,320,316.198,320,266.666z">
                                                        </path>
                                                        <path
                                                            d="M293.875,172.448c-4.906-3.229-11.49-1.906-14.75,2.969C278.177,176.833,256,210.75,256,266.666     c0,29.865,6.437,53.333,11.844,67.76c1.604,4.281,5.667,6.927,9.99,6.927c1.24,0,2.51-0.219,3.74-0.677     c5.521-2.063,8.313-8.208,6.25-13.729c-4.781-12.781-10.49-33.615-10.49-60.281c0-49.083,19.365-79.146,19.563-79.448     C300.125,182.302,298.771,175.698,293.875,172.448z">
                                                        </path>
                                                        <circle cx="383.999" cy="234.665" r="21.333"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg></span>
                                    <h3 class="u-text u-text-2">fish</h3>
                                    <a href="{{ route('Fish') }}" class="u-link u-link-2">view all <i
                                            class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div
                                class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-size-12 u-size-30-md u-layout-cell-3">
                                <div
                                    class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-valign-top-lg u-valign-top-xl u-container-layout-3">
                                    <span class="u-icon u-icon-circle u-text-palette-1-base u-icon-3"><svg
                                            class="u-svg-link" preserveAspectRatio="xMidYMin slice"
                                            viewBox="0 0 512.001 512.001" style="">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-5af2"></use>
                                        </svg><svg class="u-svg-content" viewBox="0 0 512.001 512.001" x="0px"
                                            y="0px" id="svg-5af2"
                                            style="enable-background:new 0 0 512.001 512.001;">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M503.45,324.28H8.55c-4.71,0-8.533,3.814-8.533,8.533c0,98.801,80.379,179.188,179.188,179.188h153.59    c98.801,0,179.188-80.387,179.188-179.188C511.983,328.094,508.169,324.28,503.45,324.28z M332.795,494.935h-153.59    c-86.531,0-157.447-68.143-161.901-153.59h477.391C490.242,426.792,419.326,494.935,332.795,494.935z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M435.223,119.545c0-0.623-0.009-1.246-0.068-2.193c-1.314-14.147-11.041-25.769-23.883-30.129l9.659-9.659    c16.75-16.408,18.431-42.655,3.771-61.188c-15.7-19.079-43.995-21.793-63.066-6.101c-1.084,0.896-2.133,1.843-3.183,2.893    l-10.495,10.649c-4.403-12.774-16.05-22.433-30.402-23.764c-18.9-1.032-34.899,13.473-35.914,32.262    c-0.034,0.623-0.043,1.246-0.043,1.86v13.081c-5.017-2.91-10.828-4.582-17.031-4.591c-0.614,0-1.246,0.017-2.193,0.068    c-18.243,1.698-32.279,17.373-31.972,35.547v11.605c-5.12-2.961-10.956-4.548-17.031-4.557c-0.614,0-1.237,0.017-2.184,0.068    c-18.252,1.698-32.288,17.373-31.981,35.548v126.541c0,4.719,3.823,8.533,8.533,8.533h145.057    c18.823,0,34.131-15.308,34.122-34.114c0-6.212-1.664-12.04-4.582-17.065h11.528c18.328,0.503,34.003-13.738,35.718-32.314    c0.367-6.946-1.374-13.516-4.667-19.096c7.662-0.853,14.753-4.241,20.282-9.753C431.647,137.242,435.214,128.675,435.223,119.545z     M413.148,131.593c-3.225,3.208-7.5,4.975-12.065,4.975c-0.009,0-0.017,0-0.026,0h-25.598c-4.719,0-8.533,3.823-8.533,8.533    s3.814,8.533,8.533,8.533l0.939,0.026c9.403,0.503,16.639,8.558,16.161,17.62c-0.87,9.403-8.848,16.682-18.55,16.485h-41.213    c-4.719,0-8.533,3.823-8.533,8.533s3.814,8.533,8.533,8.533c9.412,0,17.066,7.654,17.066,17.066s-7.654,17.066-17.066,17.066    H196.271V120.799c-0.162-9.446,7.091-17.526,16.161-18.38l0.93-0.026c9.395,0.008,17.031,7.654,17.04,17.04v0.06    c0,4.71,3.814,8.533,8.524,8.533c0.009,0,0.009,0,0.009,0c4.71,0,8.524-3.814,8.533-8.524v-0.008V78.135    c-0.162-9.446,7.091-17.526,16.161-18.38l0.922-0.026c9.403,0.017,17.04,7.662,17.049,17.057v0.051    c0,4.71,3.814,8.533,8.524,8.533c0.009,0,0.009,0,0.009,0c4.71,0,8.524-3.814,8.533-8.524v-0.009V34.174l0.026-0.947    c0.495-9.395,8.362-16.63,17.612-16.161c9.42,0.879,16.664,8.959,16.485,18.567v7.082c0,3.456,2.091,6.579,5.299,7.893    c3.183,1.314,6.886,0.563,9.309-1.911l23.149-23.491c0.631-0.623,1.28-1.212,1.954-1.766c11.809-9.71,29.31-8.021,38.935,3.652    c9.113,11.536,8.063,27.987-2.5,38.338l-22.441,22.441c-2.44,2.44-3.174,6.109-1.852,9.301c1.314,3.183,4.437,5.265,7.884,5.265    h7.082c0.179,0,0.307,0,0.452,0c9.318,0,17.236,7.185,18.072,16.161l0.026,0.939C418.148,124.093,416.374,128.376,413.148,131.593    z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="87.075" y="170.67"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -51.7312 233.5161)"
                                                        width="337.877" height="17.065"></rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="315.713" y="68.348" width="17.066" height="42.664">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="264.516" y="111.012" width="17.066" height="51.197">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="213.319" y="153.59" width="17.066" height="59.729">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="324.245" y="102.479" width="42.664" height="17.065">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="273.049" y="153.59" width="51.197" height="17.065">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="221.852" y="204.787" width="59.729" height="17.066">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M159.281,39.473c-0.008-0.017-0.026-0.034-0.034-0.051c-12.04-18.03-36.512-22.928-54.533-10.888    c-0.563,0.367-1.118,0.759-1.749,1.229l-3.072,2.338l-2.952-2.125C81.326,15.411,56.777,16,41.913,31.427    c-7.278,7.543-11.186,17.475-10.99,27.962c0.196,10.487,4.454,20.265,11.989,27.535c2.193,2.116,4.633,3.976,7.261,5.529    l7.185,5.615v4.369c0,23.525,19.139,42.664,42.664,42.664s42.664-19.148,42.655-42.672v-4.369l7.552-5.896    C166.568,79.765,170.536,56.616,159.281,39.473z M139.818,78.647l-10.922,8.533c-2.065,1.613-3.277,4.096-3.277,6.724v8.533    c0,14.113-11.485,25.598-25.598,25.598c-14.113,0-25.598-11.485-25.598-25.598v-8.533c0-2.628-1.203-5.111-3.277-6.724    l-10.922-8.533c-0.324-0.256-0.674-0.486-1.032-0.691c-1.604-0.913-3.089-2.022-4.42-3.311c-4.266-4.113-6.673-9.642-6.784-15.564    c-0.111-5.922,2.099-11.536,6.212-15.803c4.343-4.505,10.154-6.775,15.973-6.775c5.546,0,11.101,2.056,15.402,6.212    c0.29,0.273,0.597,0.538,0.93,0.776l8.533,6.144c3.038,2.193,7.159,2.142,10.146-0.128l8.994-6.766    c4.949-3.311,10.879-4.471,16.716-3.319c5.819,1.16,10.845,4.514,14.147,9.446C151.372,58.544,149.119,71.582,139.818,78.647z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="187.721" y="8.533" width="17.066" height="17.065">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="238.918" y="281.582" width="17.065" height="17.065">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M460.787,51.24v17.066c9.412,0,17.066,7.654,17.066,17.065s-7.654,17.066-17.066,17.066v17.065    c18.823,0,34.131-15.308,34.131-34.131C494.918,66.548,479.61,51.24,460.787,51.24z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="17.066" y="128.077" width="17.065" height="17.066">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="0.017" y="93.946" width="17.065" height="17.066">
                                                    </rect>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M332.795,273.083c-18.823,0-34.131,15.308-34.131,34.131h17.066c0-9.412,7.654-17.066,17.065-17.066    c9.412,0,17.066,7.654,17.066,17.066h17.065C366.926,288.391,351.618,273.083,332.795,273.083z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M102.411,196.288h-1.075C97.53,181.586,84.159,170.69,68.28,170.69s-29.259,10.896-33.056,25.598h-1.075    c-18.823,0-34.131,15.308-34.131,34.131c0,18.823,15.308,34.131,34.131,34.131h68.262c18.823,0,34.131-15.308,34.131-34.131    C136.542,211.596,121.234,196.288,102.411,196.288z M102.411,247.493H34.148c-9.412,0-17.066-7.654-17.066-17.065    c0-9.412,7.654-17.066,17.066-17.066h8.533c4.71,0,8.533-3.823,8.533-8.533c0-9.412,7.654-17.065,17.066-17.065    s17.066,7.654,17.066,17.065c0,4.71,3.823,8.533,8.533,8.533h8.533c9.412,0,17.066,7.654,17.066,17.066    C119.476,239.84,111.822,247.493,102.411,247.493z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M85.345,247.485H51.214c-4.71,0-8.533,3.823-8.533,8.533v34.131c0,4.719,3.823,8.533,8.533,8.533h34.131    c4.71,0,8.533-3.814,8.533-8.533v-34.131C93.878,251.308,90.055,247.485,85.345,247.485z M76.812,281.616H59.747v-17.065h17.066    V281.616z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M452.254,221.887c-14.113,0-25.598,11.485-25.598,25.598s11.485,25.598,25.598,25.598    c14.113,0,25.598-11.485,25.598-25.598S466.367,221.887,452.254,221.887z M452.254,256.026c-4.71,0-8.533-3.831-8.533-8.533    c0-4.702,3.823-8.533,8.533-8.533s8.533,3.823,8.533,8.533C460.787,252.204,456.964,256.026,452.254,256.026z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M452.254,187.756c-32.928,0-59.729,26.793-59.729,59.729s26.801,59.729,59.729,59.729    c32.928,0,59.729-26.793,59.729-59.729S485.182,187.756,452.254,187.756z M452.254,290.157c-23.525,0-42.664-19.147-42.664-42.664    c0-23.525,19.139-42.664,42.664-42.664c23.525,0,42.664,19.139,42.664,42.664C494.918,271.018,475.779,290.157,452.254,290.157z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg></span>


                                    <h3 class="u-text u-text-2">vegetables</h3>
                                    <a href="{{ route('Vegetable') }}" class="u-link u-link-2">view all <i
                                            class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </div>


                            <div
                                class="u-align-right u-container-style u-layout-cell u-right-cell u-size-24 u-size-30-md u-layout-cell-4">
                                <div class="u-container-layout u-valign-middle u-container-layout-4">

                                    @foreach ($abouts as $about)
                                        <h2 class="u-text u-text-4">{{ $about->title }}</h2>
                                        <p class="u-text u-text-5">{{ Str::substr($about->description, 0, 350) }}...</p>
                                        {{-- single controller ko name route ma bhako --}}
                                        <a href="{{ route('About') }}" class="u-btn u-button-style u-btn-1">Read More</a>
                                    @endforeach
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="u-clearfix u-palette-3-base u-section-3" id="sec-8837">
        <div class="container">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-expanded-width-sm u-expanded-width-xs u-gutter-20 u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div class="u-container-style u-layout-cell u-right-cell u-size-20 u-layout-cell-1">


                                <div class="u-container-layout">

                                    {{-- @foreach ($categoriesun as $category) --}}
                                    @foreach ($firstpost as $post)
                                        <a href="/postview/{{ $post->id }}">
                                            <img class="u-expanded-width u-image u-image-1"
                                                src="{{ asset('uploads/post/' . $post->image) }}" alt="Post Image">
                                        </a>
                                        <h3 class="u-text-head">{{ $post->title }}</h3>
                                        <p class="u-text u-text-1">
                                            {{ Str::substr($post->description, 0, 200) }}...
                                        </p>
                                    @endforeach
                                    {{-- @endforeach --}}


                                </div>
                            </div>

                            @foreach ($secondpost as $post)
                                <div class="u-container u-layout-cell u-size-20 u-layout-cell-2">
                                    <div class="u-container-layout">
                                        <a href="/postview/{{ $post->id }}">
                                            <img class="u-expanded-width u-image u-image-2"
                                                src="{{ url('uploads/post/' . $post->image) }}">
                                        </a>
                                    </div>
                                </div>

                                <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-3">
                                    <div class="u-container-layout u-valign-middle-sm u-container-layout-3">
                                        <h3 class="u-text-head-2">{{ $post->title }}</h3>
                                        <p class="u-text u-text-2">
                                            {{ Str::substr($post->description, 0, 200) }}...
                                        </p>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="u-clearfix u-palette-11-base u-section-4" id="sec-54c4">
        <div class="container">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div class="u-container-style u-layout-cell u-right-cell u-size-40 u-layout-cell-1">
                                <div class="u-container-layout u-valign-middle u-container-layout-1">
                                    @foreach ($welcomes as $welcome)
                                        <h3 class="u-text u-text-1">{{ $welcome->title }}</h3>
                                        <h2 class="u-text u-text-2">{{ $welcome->subtitle }}</h2>
                                        <p class="u-text u-text-3">{{ Str::substr($welcome->description, 0, 450) }}</p>
                                        <a href="{{ route('Viewmenu') }}" class="u-btn u-button-style u-palette-2-base u-btn-1" id="viewMenuBtn">View Menu</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="u-container-style u-layout-cell u-left-cell u-size-20 u-layout-cell-2">
                                <div class="u-container-layout">
                                    <img class="u-expanded-width u-image u-image-1" src="{{ url('uploads/welcome/' . $welcome->image) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div id="menuModal" class="modals">
        <div class="modal-contents">
            <span class="close" aria-label="Close">&times;</span>
            <div id="menuContent"></div>
        </div>
    </div>   
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("menuModal");
            var btn = document.getElementById("viewMenuBtn");
            var menuContent = document.getElementById("menuContent");

            // Event listener for the close button
            document.body.addEventListener('click', function(event) {
                if (event.target.matches('#menuModal .close')) {
                    console.log('Close button clicked');
                    modal.style.display = "none";
                }
            });

            btn.onclick = function(e) {
                e.preventDefault();
                fetch('{{ route('Viewmenu') }}')
                    .then(response => response.text())
                    .then(data => {
                        var parser = new DOMParser();
                        var doc = parser.parseFromString(data, 'text/html');
                        var content = doc.querySelector('.services_page').outerHTML;
                        menuContent.innerHTML = content;
                        modal.style.display = "block";
                        
                        // Reapply the event listeners for the modal content
                        initModalScripts();
                    });
            }

            // Close modal when clicking outside
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    
        function initModalScripts() {
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
    
            function updateCart(itemName, price, quantity) {
                if (quantity > 0) {
                    cart[itemName] = { price: price, quantity: quantity };
                } else {
                    delete cart[itemName];
                }
                localStorage.setItem('cart', JSON.stringify(cart));
            }
    
            document.querySelectorAll('.addButton').forEach(button => {
                button.addEventListener('click', function() {
                    const quantityControl = this.closest('.quantityControl');
                    this.style.display = 'none';
                    quantityControl.querySelector('.quantitySelector').style.display = 'flex';
                    
                    const itemName = this.closest('.itemWrap').querySelector('.itemName').textContent;
                    const price = this.closest('.itemWrap').querySelector('.itemPrice').textContent;
                    updateCart(itemName, price, 1);
                });
            });
    
            document.querySelectorAll('.decreaseQuantity').forEach(button => {
                button.addEventListener('click', function() {
                    const quantitySpan = this.parentElement.querySelector('.quantity');
                    let quantity = parseInt(quantitySpan.textContent);
                    if (quantity > 1) {
                        quantity--;
                        quantitySpan.textContent = quantity;
                    } else {
                        const quantityControl = this.closest('.quantityControl');
                        quantityControl.querySelector('.quantitySelector').style.display = 'none';
                        quantityControl.querySelector('.addButton').style.display = 'inline-block';
                        quantity = 0;
                    }
                    
                    const itemName = this.closest('.itemWrap').querySelector('.itemName').textContent;
                    const price = this.closest('.itemWrap').querySelector('.itemPrice').textContent;
                    updateCart(itemName, price, quantity);
                });
            });
    
            document.querySelectorAll('.increaseQuantity').forEach(button => {
                button.addEventListener('click', function() {
                    const quantitySpan = this.parentElement.querySelector('.quantity');
                    let quantity = parseInt(quantitySpan.textContent);
                    quantity++;
                    quantitySpan.textContent = quantity;
                    
                    const itemName = this.closest('.itemWrap').querySelector('.itemName').textContent;
                    const price = this.closest('.itemWrap').querySelector('.itemPrice').textContent;
                    updateCart(itemName, price, quantity);
                });
            });
        }
    </script>
    


    {{-- For another service --}}
    <section class="u-clearfix u-palette-3-base u-section-6" id="carousel_e4a6">
        <div class="container">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-expanded-width-sm u-expanded-width-xs u-gutter-20 u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div
                                class="u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-left-cell u-size-20 u-layout-cell-1">
                                <div
                                    class="u-container-layout u-valign-middle-lg u-valign-middle-sm u-valign-middle-xl u-valign-middle-xs u-container-layout-1">


                                    {{-- desserts and safari --}}

                                    <h2 class="u-text u-text-1">
                                        @foreach ($thirdpost as $post)
                                            {{ $post->title }}
                                        @endforeach


                                        &amp;<br>

                                        @foreach ($fourthpost as $post)
                                            {{ $post->title }}
                                        @endforeach


                                    </h2>


                                    <a href="{{ route('Allpost') }}"
                                        class="u-btn u-button-style u-palette-2-base u-btn-1">view
                                        all services</a>
                                </div>
                            </div>

                            @foreach ($thirdpost as $post)
                                <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-2">
                                    <div class="u-container-layout">



                                        <a href="/postview/{{ $post->id }}">
                                            <img class="u-expanded-width u-image u-image-1"
                                                src="{{ asset('uploads/post/' . $post->image) }}" alt="About us">
                                        </a>
                                        <p class="u-text u-text-2">
                                            {{ Str::substr($post->description, 0, 200) }}...
                                        </p>
                            @endforeach
                        </div>
                    </div>

                    @foreach ($fourthpost as $post)
                        <div class="u-container-style u-layout-cell u-right-cell u-size-20 u-layout-cell-3">
                            <div class="u-container-layout u-valign-bottom-sm">


                                <a href="/postview/{{ $post->id }}">
                                    <img class="u-expanded-width-lg u-expanded-width-md u-expanded-width-xl u-image u-image-2"
                                        src="{{ asset('uploads/post/' . $post->image) }}" alt="About us">
                                </a>
                                <p class="u-text u-text-2">
                                    {{ Str::substr($post->description, 0, 200) }}...
                                </p>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>


    {{-- For Services page --}}
    <section class="services_page bg_two">
        <div class="container">
            <div class="box-wrapper row">
                @foreach ($foodposts as $post)
                    <div class="col-md-3">
                        <figure class="shape-box shape-box_half">
                            <img src="{{ asset('uploads/post/' . $post->image) }}" alt="">
                            <div class="brk-abs-overlay z-index-0 bg-black opacity-60"></div>
                            <figcaption>
                                <div class="show-cont">
                                    {{-- <h3 class="card-no">{{ $loop->iteration }}</h3> --}}
                                    <h4 class="card-main-title">{{ $post->title }}</h4>
                                </div>
                                <p class="card-content">
                                    {{ Str::substr($post->description, 0, 150) }}
                                </p>
                                <a href="{{ route('Post', $post->id) }}" class="read-more-btn">Read More</a>
                            </figcaption>
                            <span class="after"></span>
                        </figure>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="u-clearfix u-image u-section-5" id="sec-df97">
        <div class="u-clearfix u-sheet u-sheet-1">
            @if ($backimages)
                <img class="sec5_image" src="{{ url('uploads/backimage/' . $backimages->image) }}" alt="Backimage">
            @endif
        </div>
    </section>
    

    <section class="u-clearfix u-palette-3-base u-section-6" id="carousel_e4a6">
        <div class="container">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-expanded-width-sm u-expanded-width-xs u-gutter-20 u-layout-wrap u-layout-wrap-1">
                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div
                                class="u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-left-cell u-size-20 u-layout-cell-1">
                                <div
                                    class="u-container-layout u-valign-middle-lg u-valign-middle-sm u-valign-middle-xl u-valign-middle-xs u-container-layout-1">
                                    {{-- desserts and safari --}}

                                    <h2 class="u-text u-text-1">
                                        @foreach ($fifthpost as $post)
                                            {{ $post->title }}
                                        @endforeach


                                        &amp;<br>

                                        @foreach ($sixthpost as $post)
                                            {{ $post->title }}
                                        @endforeach


                                    </h2>


                                    <a href="{{ route('Allpost') }}"
                                        class="u-btn u-button-style u-palette-2-base u-btn-1">view
                                        all services</a>
                                </div>
                            </div>

                            @foreach ($fifthpost as $post)
                                <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-2">
                                    <div class="u-container-layout">
                                        <a href="/postview/{{ $post->id }}">
                                            <img class="u-expanded-width u-image u-image-1"
                                                src="{{ asset('uploads/post/' . $post->image) }}" alt="About us">
                                        </a>
                                        <p class="u-text u-text-2">
                                            {{ Str::substr($post->description, 0, 200) }}...
                                        </p>
                            @endforeach
                        </div>
                    </div>

                    @foreach ($sixthpost as $post)
                        <div class="u-container-style u-layout-cell u-right-cell u-size-20 u-layout-cell-3">
                            <div class="u-container-layout u-valign-bottom-sm">
                                <a href="/postview/{{ $post->id }}">
                                    <img class="u-expanded-width-lg u-expanded-width-md u-expanded-width-xl u-image u-image-2"
                                        src="{{ asset('uploads/post/' . $post->image) }}" alt="About us">
                                </a>
                                <p class="u-text u-text-2">
                                    {{ Str::substr($post->description, 0, 200) }}...
                                </p>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>



    {{-- PHOTO GALLERY --}}


    <section class="u-clearfix u-section-7" id="sec-1c37">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div class="u-layout-col">
                    <div class="u-size-30">
                        <div class="u-layout-row">
                            @foreach ($photogallerys as $photogallery)
                                <div class="u-container-style u-image u-layout-cell u-left-cell u-size-20 u-image-1">
                                    <div class="u-container-layout">

                                        <figure class="gal_fig">
                                            <a href="{{ route('Gallery') }}">
                                                <img class="gallery_image"
                                                    src="{{ url('uploads/gallery/' . $photogallery->image) }}"
                                                    alt="galleryimage">
                                        </figure>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- </div> --}}
@stop
