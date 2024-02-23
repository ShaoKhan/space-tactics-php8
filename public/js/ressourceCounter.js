$(document).ready(function () {

    let $metalElement = $('.res_metal');
    let $crystalElement = $('.res_crystal');
    let $deuteriumElement = $('.res_deuterium');

    let resources = {
        metal: {
            initial: $metalElement.data('res-count'),
            production: $metalElement.data('res-prod')
        },
        crystal: {
            initial: $crystalElement.data('res-count'),
            production: $crystalElement.data('res-prod')
        },
        deuterium: {
            initial: $deuteriumElement.data('res-count'),
            production: $deuteriumElement.data('res-prod')
        }
    };

    updateResourceValues(resources.metal.initial, resources.crystal.initial, resources.deuterium.initial, resources.metal.production, resources.crystal.production, resources.deuterium.production);

    setInterval(function () {
        resources.metal.initial += resources.metal.production;
        resources.crystal.initial += resources.crystal.production;
        resources.deuterium.initial += resources.deuterium.production;

        updateResourceValues(resources.metal.initial, resources.crystal.initial, resources.deuterium.initial, resources.metal.production, resources.crystal.production, resources.deuterium.production);
    }, 1000);

    // ################################################
    // save resources on every click on a-tag or button
    // ################################################
    $("a").each(function () {

        $(this).on("click", function (e) {

            let slug = window.location.pathname.split('/')[2];


            let data = {
                amountMetal: $('.res_metal').attr('data-res-count'),
                amountCrystal: $('.res_crystal').attr('data-res-count'),
                amountDeuterium: $('.res_deuterium').attr('data-res-count'),
            };

            $.ajax({
                type: "POST",
                url: "/saveResource/" + slug,
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function (response) {
                    // e.preventDefault();
                },
                error: function () {
                    //
                }
            });

        });
    });

});

function updateResourceValues(metalValue, crystalValue, deuteriumValue) {
    $(".res_metal").text(Math.ceil(metalValue).toLocaleString()).attr('data-res-count', Math.ceil(metalValue));
    $(".res_crystal").text(Math.ceil(crystalValue).toLocaleString()).attr('data-res-count', Math.ceil(crystalValue));
    $(".res_deuterium").text(Math.ceil(deuteriumValue).toLocaleString()).attr('data-res-count', Math.ceil(deuteriumValue));
}