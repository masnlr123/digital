// Class definition
var KTSelect2 = function() {
    // Private functions
    var demos = function() {
        // basic
        $('#kt_select2_1, #kt_select2_1_validate').select2({
            placeholder: "Select a state"
        });
        $('#mail_to').select2({
            placeholder: "Select a Mail Users"
        });
        $('#select2_select').select2({
            placeholder: ""
        });
        $('#select2_select1').select2({
            placeholder: ""
        });
        $('#select2_select2').select2({
            placeholder: ""
        });
        $('#select2_select3').select2({
            placeholder: ""
        });
        $('#select2_select4').select2({
            placeholder: ""
        });
        $('#select2_select5').select2({
            placeholder: ""
        });
        $('#select2_select6').select2({
            placeholder: ""
        });
        $('#select2_select7').select2({
            placeholder: ""
        });
        $('#select2_select8').select2({
            placeholder: ""
        });
        $('#select2_select9').select2({
            placeholder: ""
        });
        $('#select2_select10').select2({
            placeholder: ""
        });
        $('#mail_cc').select2({
            placeholder: "Select a Mail Users"
        });
        $('#select_projects').select2({
            placeholder: "Select a Projects"
        });
        $('#select_task_for').select2({
            placeholder: "Select a Task For"
        });
        $('#select_task_cat').select2({
            placeholder: "Select a Task Category"
        });
        $('#select_campaign').select2({
            placeholder: "Select a Campaign"
        });
        $('#select_default_name').select2({
            placeholder: "Select a Campaign Basis"
        });
        $('#select_campaign_type').select2({
            placeholder: "Select a Campaign Type"
        });
        $('#select_channel').select2({
            placeholder: "Select a Channel"
        });
        $('#select_setting_name').select2({
            placeholder: "Select Setting Name"
        });
        $('#select_setting_type').select2({
            placeholder: "Select Setting Type"
        });
        $('#setting_select_type').select2({
            placeholder: "Choose one Select Type"
        });
        // $('#select_creative_type').select2({
        //     placeholder: "Select a Creative Type"
        // });
        $('#select_priority').select2({
            placeholder: "Select a Priority"
        });
        $('#select_task_status').select2({
            placeholder: "Choose a Task Status"
        });
        $('#select_assigned_to').select2({
            placeholder: "Select a Assigned Person"
        });
        $('#process_transfer_to').select2({
            placeholder: "Select a Transfer Person"
        });
        $('#approval_person').select2({
            placeholder: "Choose a Approval Person"
        });
        $('#paid_campaign_assigned_to').select2({
            placeholder: "Choose a Person"
        });
        $('#select_status').select2({
            placeholder: "Choose a Status"
        });
        $('#select_source').select2({
            placeholder: "Choose a Source"
        });
        $('#select_lms_task_type').select2({
            placeholder: "Choose a Task Type"
        });
        $('#select_lms_task_daily').select2({
            placeholder: "Choose a Task Type"
        });
        $('#select_lms_task_dev').select2({
            placeholder: "Choose a Task Type"
        });

        // nested
        $('#kt_select2_2, #kt_select2_2_validate').select2({
            placeholder: "Select a state"
        });

        // multi select
        $('#kt_select2_3, #kt_select2_3_validate').select2({
            placeholder: "Select a state",
        });


        $('#select_creative_type').select2({
            placeholder: "Select a Creative Type",
        });

        // basic
        $('#kt_select2_4').select2({
            placeholder: "Select a state",
            allowClear: true
        });

        // loading data from array
        var data = [{
            id: 0,
            text: 'Enhancement'
        }, {
            id: 1,
            text: 'Bug'
        }, {
            id: 2,
            text: 'Duplicate'
        }, {
            id: 3,
            text: 'Invalid'
        }, {
            id: 4,
            text: 'Wontfix'
        }];

        $('#kt_select2_5').select2({
            placeholder: "Select a value",
            data: data
        });

        // loading remote data

        function formatRepo(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";
            if (repo.description) {
                markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
            }
            markup += "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
                "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                "</div>" +
                "</div></div>";
            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        $("#kt_select2_6").select2({
            placeholder: "Search for git repositories",
            allowClear: true,
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        // custom styles

        // tagging support
        $('#kt_select2_12_1, #kt_select2_12_2, #kt_select2_12_3, #kt_select2_12_4').select2({
            placeholder: "Select an option",
        });

        // disabled mode
        $('#kt_select2_7').select2({
            placeholder: "Select an option"
        });

        // disabled results
        $('#kt_select2_8').select2({
            placeholder: "Select an option"
        });

        // limiting the number of selections
        $('#kt_select2_9').select2({
            placeholder: "Select an option",
            maximumSelectionLength: 2
        });

        // hiding the search box
        $('#kt_select2_10').select2({
            placeholder: "Select an option",
            minimumResultsForSearch: Infinity
        });

        // tagging support
        $('#kt_select2_11').select2({
            placeholder: "Add a tag",
            tags: true
        });

        // disabled results
        $('.kt-select2-general').select2({
            placeholder: "Select an option"
        });
    }

    var modalDemos = function() {
        $('#kt_select2_modal').on('shown.bs.modal', function () {
            // basic
            $('#kt_select2_1_modal').select2({
                placeholder: "Select a state"
            });

            // nested
            $('#kt_select2_2_modal').select2({
                placeholder: "Select a state"
            });

            // multi select
            $('#kt_select2_3_modal').select2({
                placeholder: "Select a state",
            });

            // basic
            $('#kt_select2_4_modal').select2({
                placeholder: "Select a state",
                allowClear: true
            }); 
        });
    }

    // Public functions
    return {
        init: function() {
            demos();
            modalDemos();
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTSelect2.init();
});