/*
 * space-tactics-php8
 * galaxymap.js | 1/26/23, 9:09 PM
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

    $('.galaxy-item').click(function (e) {
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
                let halfCoords = $('.message_' + coords[0] + '_' + coords[1]).data('width') / 2;
                let top = e.pageY + 'px';
                let left = e.pageX + 'px';
                if (coords[1] > halfCoords) {
                    left = (e.pageX - 420) + 'px';
                }

                $('.message').html('').css('display', 'none');
                if (data.message.length > 0) {
                    for (let i = 0; i < data.message.length; i++) {

                        let result = data.message[i];
                        html += '<div class="row">';
                        html += '<div class="col-4 planet">' + result.name + '</div>';
                        html += '<div class="col-3 player">' + result.user + '</div>';
                        html += '<div class="col-2 coords">' + coords[0] + ':' + coords[1] + ':' + result.z + '</div>';
                        html += '<div class="col-3">'

                        /*if (data.user !== result.id) {
                            html += '<i class="bi bi-eye sendSpio" data-content="' + result.id + '" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Spionage"></i>'
                                + '<i class="bi bi-envelope-at sendMessage" data-content="' + result.id + '" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Nachricht senden"></i>'
                                + '<i class="bi bi-person-plus addFriend" data-content="' + result.id + '" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Als Freund adden" onClick="addFriend(\'' + result.id + '\')"></i>';
                        }*/


                        html += '</div>'
                            + '</div>';

                    }
                    $('.message_' + coords[0] + '_' + coords[1]).html(html).css({
                        position: 'absolute',
                        top: top,
                        left: left
                    }).toggle('display');

                }
            },
            error: function (data) {

            }
        })
    });
});