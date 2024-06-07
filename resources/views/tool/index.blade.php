@extends('layouts.master')
@section('content')
    <form id="keywordDensityInputForm">
        <div class="form-floating mb-2">
            <label for="keywordDensityInput" class="text-info"><strong>HTML / Text</strong></label>
            <textarea class="form-control text-info backgroundColor-black border-0 custom-textarea" placeholder="Paste or type your text for keyword analysis" id="keywordDensityInput" style="height: 200px"></textarea>
        </div>
        <button type="submit" class="btn btn-info mb-5 text-dark">Get Keyword Densities</button>
        <div class="mb-5 justify-content-center" id="loader-spinner">
            <div class="spinner-grow text-info" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </form>
    <div id="customModal" class="customModal text-info p-5 rounded">
        <div class="customModal-content">
            <h2 class="customModal-heading">customModal Heading</h2>
            <p class="customModal-message">This is the message inside the customModal.</p>
            <button id="closeCustomModalBtn" class="close-button btn btn-info text-dark">OK</button>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#keywordDensityInputForm').on('submit', function (e) { // Listen for submit button click and form submission.
            e.preventDefault(); // Prevent the form from submitting
            let kdInput = $('#keywordDensityInput').val(); // Get the input
            if (kdInput !== "") { // If input is not empty.
			    // Set CSRF token up with ajax.
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Show the loader before making the AJAX call
                $('#loader-spinner').addClass('d-flex');
                $('#loader-spinner').show();

                $.ajax({ // Pass data to backend
                    type: "POST",
                    url: "api/tool/calculate-and-get-density",
                    data: {'keywordInput': kdInput},
                    success: function (response) {
                        // Hide the loader after making the AJAX call
                        $('#loader-spinner').removeClass('d-flex');
                        $('#loader-spinner').hide();

                        // On Success, build a data table with keyword and densities
                        if (response.keywordDensityArray.length > 0) {
                            $('#customModal').show();
                            $('.customModal-heading').text(response.heading);
                            $('.customModal-message').text(response.message);

                            $('#closeCustomModalBtn').on('click', function(e) {
                                e.preventDefault();

                                $('#customModal').hide();

                                let html = "<table class='table'><tbody><thead>";
                                html += "<th class='text-info'>Keyword</th>";
                                html += "<th class='text-info'>Count</th>";
                                html += "<th class='text-info'>Density</th>";
                                html += "</thead><tbody>";

                                for (let i = 0; i < response.keywordDensityArray.length; i++) {
                                    html += "<tr><td class='text-info'>"+response.keywordDensityArray[i].keyword+"</td>";
                                    html += "<td class='text-info'>"+response.keywordDensityArray[i].count+"</td>";
                                    html += "<td class='text-info'>"+response.keywordDensityArray[i].density+"%</td></tr>";
                                }

                                html += "</tbody></table>";

                                $('#keywordDensityInputForm').after(html); // Append the html table after the form.
                            })
                        } else {
                            $('#customModal').show();
                            $('.customModal-heading').text('Oops! An Unexpected Error');
                            $('.customModal-message').text("We're sorry, but an unexpected error occurred. Please try again later.");
                        }
                    },
                    error: function(error) {
                        // Hide the loader after making the AJAX call
                        $('#loader-spinner').removeClass('d-flex');
                        $('#loader-spinner').hide();

                        $('#customModal').show();
                        $('.customModal-heading').text(JSON.parse(error.responseText).error);
                        $('.customModal-message').text(JSON.parse(error.responseText).message);
                    }
                });
            } else {
                $('#customModal').show();
                $('.customModal-heading').text('Input Required');
                $('.customModal-message').text('Please paste or type text for keyword density analysis.');
            }
        })

        $('#closeCustomModalBtn').on('click', function(e) {
            e.preventDefault();

            $('#customModal').hide();
        })
    </script>
@endsection
