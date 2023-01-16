/*
 * space-tactics-php8
 * galaxymap.js | 1/16/23, 8:17 PM
 * Copyright (C)  2023 ShaoKhan
 *
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        'placement': 'bottom'
    });

    $('.galaxy-item').click(function () {
        let coords = $(this).attr('data-coords').split(':');
        let html = '';

        $.ajax({
            url: "/system-info",
            type: 'POST',
            data: {
                'x': coords[0],
                'y': coords[1]
            },
            success: function (data) {
                for (let i = 0; i < data.message.length; i++) {
                    html += '<div class="row">';
                    html += '<div class="col-4">' + data.message[i].name + '</div>';
                    html += '<div class="col-3">' + data.message[i].user + '</div>';
                    html += '<div class="col-2">'+coords[0]+':'+coords[1]+':'+ data.message[i].z + '</div>';
                    html += '<div class="col-3">'
                        +'<i class="bi bi-eye" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Spionage"></i>'
                        +'<i class="bi bi-envelope-at" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Nachricht senden"></i>'
                        +'<i class="bi bi-person-plus" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Als Freund adden"></i>'
                        +'</div>';
                    html += '</div>';
                }
                $('.message_'+coords[0]+'_'+coords[1]).html(html).toggle('display');
            },
            error: function (data) {

            }
        })
    });

});