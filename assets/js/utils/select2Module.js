export function renderSelect2 ({select, url}) {
    select.select2({
        ajax: {
            url,
            dataType: "json",
            type: "GET",
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.text,
                            id: item.id
                        }
                    })
                }
            }
        }
    })
}