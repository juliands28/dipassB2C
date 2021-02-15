const BookingUI = ( (SET) => {

    const __getBoardDate = (date, days) => {
        let new_date = new Date(date)
        let new_days = days - 1

        new_date.setDate(new_date.getDate() + new_days);
        return SET.__dateFormat(new_date);
    }

    const __getBoardDateTime = (date, time) => {
        return new Date(`${date} ${time}`)
    }

    const __getDifferenceTime = (start_date, end_date) => {
        let startDate = moment(new Date(start_date));
        let endDate = moment(new Date(end_date));
        let difference = moment.duration(endDate.diff(startDate));

        return difference.asHours()
    }

    const __checkSelectedSeat = (selected, seat_number) => {
        const found = selected.some(el => el.seat_number === seat_number)

        if(found) {
            return 'checked'
        } else {
            return ''
        }
    }

    const __activeSelectedSeat = (selected, seat_number) => {
        const found = selected.some(el => el.seat_number === seat_number)

        if(found) {
            return 'active'
        } else {
            return ''
        }
    }

    const __setPrice = (data, pickup, drop) => {
        let price = 0
        let service = data.services.filter(v => v.pickup.id === pickup.id && v.dropping.id === drop.id);

        if(service.length !== 0){
            price = service[0].price
        } else {
            price = data.price
        }

        return SET.__realCurrency(price);
    }

    return {
        __renderResults: (data, filter) => {
            let html = '',
                formated_date = filter.date.split("-").reverse().join("-")

            data.forEach((v, index) => {
                let pickup = v.route.points.filter(x => x.id === parseInt(filter.departure_point) && x.pivot.pickup_point === 1),
                    drop = v.route.points.filter(x => x.id === parseInt(filter.arrival_point) && x.pivot.drop_point === 1),
                    pickup_point,
                    drop_point

                if(pickup.length !== 0){
                    pickup_point = pickup[0]
                } else {
                    pickup_point = v.route.points.filter(x => x.city.id === parseInt(filter.departure_city) && x.pivot.pickup_point === 1)[0]
                }

                if(drop.length !== 0){
                    drop_point = drop[0]
                } else {
                    drop_point = v.route.points.filter(x => x.city.id === parseInt(filter.arrival_city) && x.pivot.drop_point === 1)[0]
                }

                let pickup_date = __getBoardDate(formated_date, pickup_point.pivot.day)
                let drop_date = __getBoardDate(formated_date, drop_point.pivot.day)

                let pickup_datetime = __getBoardDateTime(pickup_date, pickup_point.pivot.time)
                let drop_datetime = __getBoardDateTime(drop_date, drop_point.pivot.time)
                let hour_journey = __getDifferenceTime(pickup_datetime, drop_datetime).toFixed()
                let minuet_journey = (__getDifferenceTime(pickup_datetime, drop_datetime) % 1) * 100

                html += `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>${v.route.title}</b></h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-5 text-center">
                                            <p>
                                                <div><small><b>${SET.__timeFormat(pickup_point.pivot.time)} ${pickup_date === formated_date ? '' : `( ${moment(pickup_date).format("MMM D")} )`}</b></small></div>
                                                <div><small>${pickup_point.point_name}</small></div>
                                                <div><small>${SET.__replaceNull(pickup_point.address)}</small></div>
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                ${hour_journey}j ${minuet_journey.toFixed()}m
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <i class="fas fa-arrow-right fa-2x"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-5 text-center">
                                            <p>
                                                <div><small><b>${SET.__timeFormat(drop_point.pivot.time)} ${drop_date === formated_date ? '' : `( ${moment(drop_date).format("MMM D")} )`}</b></small></div>
                                                <div><small>${drop_point.point_name}</small></div>
                                                <div><small>${SET.__replaceNull(drop_point.address)}</small></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <div class="mt-3 mb-3">IDR ${__setPrice(v, pickup_point, drop_point)}</div>
                                    <a href="${SET.__baseURL()}booking/order/${v.id}?departure=${filter.departure_city || null}&pickup=${filter.departure_point || null}&arrival=${filter.arrival_city || null}&drop=${filter.arrival_point || null}" class="btn btn-block btn-success">Booking</a>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bus-${index}" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Bus</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#route-${index}" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Route</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#description-${index}" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Description</span></a> </li>
                                    </ul>
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane" id="bus-${index}" role="tabpanel">
                                            <div class="p-20">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <th style="width: 45%">Bus Name</th>
                                                                <td style="width: 5%">:</td>
                                                                <td style="width: 50%">${v.route.bus.bus_name}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Class / Category</th>
                                                                <td>:</td>
                                                                <td>${v.route.bus.class.class_name} / ${v.route.bus.category.category_name}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bus Number</th>
                                                                <td>:</td>
                                                                <td>${v.bus_number}</td>
                                                            </tr>
                                                        </table>

                                                        <div class="mt-3">
                                                            <div class="mb-2"><b>Facilities</b></div>

                                                            <div class="d-flex align-content-start flex-wrap">
                                                                ${v.route.bus.facilities.map(y => {
                                                                    return `
                                                                        <span class="badge badge-info mr-1">${y.facility_name}</span>
                                                                    `
                                                                }).join('')}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img class="img-fluid" src="${SET.__fileURL()}bus/${v.route.bus.photo}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane  p-20" id="route-${index}" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-2"><b><u>Pickup Point</u></b></div>

                                                    <div class="">
                                                        ${v.route.points.filter(x => x.pivot.pickup_point === 1).map(y => {
                                                                    let pickup_date = __getBoardDate(formated_date, y.pivot.day)

                                                                    return `
                                                                <p>
                                                                    <div><small><b>${SET.__timeFormat(y.pivot.time)} ${pickup_date === formated_date ? '' : `( ${moment(pickup_date).format("MMM D")} )`}</b></small></div>
                                                                    <div><small>${y.point_name}</small></div>
                                                                    <div><small>${SET.__replaceNull(y.address)}</small></div>
                                                                </p>
                                                            `
                                                                }).join('')}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-2"><b><u>Drop Point</u></b></div>

                                                    <div class="">
                                                        ${v.route.points.filter(x => x.pivot.drop_point === 1).map(y => {
                                                                    let drop_date = __getBoardDate(formated_date, y.pivot.day)

                                                                    return `
                                                                <p>
                                                                    <div><small><b>${SET.__timeFormat(y.pivot.time)} ${drop_date === formated_date ? '' : `( ${moment(drop_date).format("MMM D")} )`}</b></small></div>
                                                                    <div><small>${y.point_name}</small></div>
                                                                    <div><small>${SET.__replaceNull(y.address)}</small></div>
                                                                </p>
                                                            `
                                                                }).join('')}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane p-20" id="description-${index}" role="tabpanel">
                                           ${SET.__replaceNull(SET.__replaceEnter(v.route.description))}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                `
            })

            $('#results_container').html(html)
        },

        __renderNoResults: () => {
            let html = `
                <div class="d-flex align-items-center justify-content-center" style="min-height: 250px">
                    <h4 class="text-white">Service Not Found</h4>
                </div>
            `

            $('#results_container').html(html)
        },

        __renderLayout: (service, seatMap, selected_seat, points) => {
            let table = '';

            let {
                layout,
                component
            } = seatMap

            let filtered_service = service.services.filter(v => v.pickup.id === parseInt(points.pickup_point) && v.dropping.id === parseInt(points.drop_point))

            for (let a = 1; a <= layout.deck; a++) {
                table += `
                    <h4>Deck : ${a}</h4>
                    <div class="table-responsive">
                        <table style="border: 2px solid #dee2e6;" class="table t_layout" id="t_layout_${a}">
                `;

                for (let i = 0; i < layout.y; i++) {
                    table += '<tr>';

                    for (var j = 0; j < layout.x; j++) {
                        let coordinate = `${a},${i},${j}`,
                            filtered = component.filter(v => v.coordinat === coordinate)

                        table += `
                            <td class="bus_seat_container" style="border-top: 0px solid #dee2e6; height: 50px; width: 50px; padding: 0;" data-coordinat="${coordinate}">
                                ${
                                    filtered.length === 1
                                    ? filtered[0].type === 'seat' || filtered[0].type === 'sleeper' ? `
                                        <div class="btn-group-toggle" data-toggle="buttons" style="padding-top: 20%;">
                                            <label class="btn ${filtered[0].isDisabled ? 'btn-danger' : 'btn-outline-info'}  ${__activeSelectedSeat(selected_seat, filtered[0].seat_number)} ${filtered[0].isDisabled ? 'disabled' : ''}" data-toggle="tooltip" data-placement="top" title="Seat No. ${filtered[0].seat_number} | IDR Rp. ${SET.__realCurrency(filtered[0].price)}">
                                                <input class="check-seat" ${filtered[0].isDisabled ? 'disabled' : ''} ${__checkSelectedSeat(selected_seat, filtered[0].seat_number)} type="checkbox" name="seat_number[]" value="${filtered[0].seat_number}" data-price="${filtered[0].price}" /> ${filtered[0].seat_number}
                                            </label>
                                        </div>
                                    ` : `
                                        <div class="assigned" style="width: 100%; height: 100%; padding-top: 20%">
                                            <i class="${filtered[0].icon}" style="font-size: 20px"></i>
                                        </div>
                                    `
                                    : ""
                                }
                            </td>
                        `;
                    }

                    table += '</tr>';
                }

                table += `</table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-6 text-left">
                            <h5>Front</h5>
                        </div>
                        <div class="col-lg-6 col-6 text-right">
                            <h5>Back</h5>
                        </div>
                    </div>
                `;

                table += `<br/>`
            }

            $("#seat_container").html(table);
        },

        __renderWithoutLayout: () => {
            let layout = `
                <h1>Layout Not Available</h1>
            `

            $("#seat_container").html(layout);
        },

        __renderPassengerForm: selected_seat => {
            let total = selected_seat.reduce((a, b) => a + parseFloat(b.price), 0)

            let passenger_form = selected_seat.map((v, index) => {
                return `
                    <div class="col-md-12 mb-3 pessenger-border">
                        <h5 class="d-flex justify-content-end">Seat Number : <b>${v.seat_number}</b></h5>
                        <input type="hidden" class="passenger_seat_number" data-index="${index}" name="passenger_seat_number[${index}]" id="passenger_seat_number_${index}" value="${v.seat_number}">
                        <input type="hidden" class="passenger_pax_price" data-index="${index}" name="passenger_pax_price[${index}]" id="passenger_pax_price_${index}" value="${v.price}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="${v.passenger_name || ''}" class="form-control passenger_name" data-index="${index}" type="text" name="passenger_name[${index}]" id="passenger_name_${index}" required>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control passenger_gender" data-index="${index}" name="passenger_gender[${index}]" id="passenger_gender_${index}" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age</label>
                                    <input value="${v.passenger_age || ''}" class="form-control passenger_age" data-index="${index}" type="number" name="passenger_age[${index}]" id="passenger_age_${index}" required>
                                </div>
                                <div class="form-group">
                                    <label>NIK / Passport</label>
                                    <input value="${v.passenger_nik || ''}" class="form-control passenger_nik" data-index="${index}" type="number" name="passenger_nik[${index}]" id="passenger_nik_${index}" required>
                                </div>
                            </div>
                        </div>


                        <h5 class="d-flex justify-content-end">IDR ${SET.__realCurrency(parseInt(v.price))}</h5>
                    </div>
                `
            }).join('')

            passenger_form += `
                <h1>IDR ${SET.__realCurrency(total)}</h1>
            `

            $('#passenger_container').html(passenger_form)
        },

        __renderConfirmPrice: (selected_seat, points, service) => {
            let total = selected_seat.reduce((a, b) => a + parseFloat(b.price), 0);
            let pickup_point = service.route.points.filter(v => v.id === parseInt(points.pickup_point))
            let drop_point = service.route.points.filter(v => v.id === parseInt(points.drop_point))

            let pickup_date = __getBoardDate(service.date, pickup_point[0].pivot.day)
            let drop_date = __getBoardDate(service.date, drop_point[0].pivot.day)

            let html = `
                <div class="col-md-12 mb-3">
                    <div class="alert alert-success">
                        <h3 class="text-success"><i class="fa fa-check-circle"></i> Perhatian</h3> Silakan periksa pesanan Anda. Ini adalah harga total dan Anda tidak perlu membayar biaya tambahan apa pun di titik berangkat.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Passenger</h4> 
            `

            html += selected_seat.map(v => {
                return `
                    <blockquote>
                        <h5 class="mb-2">${v.passenger_name} ( ${v.passenger_gender} )</h5>
                        <p>
                            NIK : ${v.passenger_nik} <br/>
                            Age : ${v.passenger_age}
                        </p>
                        <small>- Seat Number : ${v.seat_number} | <b>IDR ${SET.__realCurrency(v.price)}</b></small>
                    </blockquote>                 
                `
            }).join('')

            html += `
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h4>Rute</h4>
                            <blockquote>
                                <div class="row">
                                    <div class="col-md-5 text-center">
                                        <h5 class="mb-2">${pickup_point[0].city.city_name}</h5>
                                        <p>${pickup_point[0].point_name}</p>
                                        <small>${pickup_point[0].pivot.time} at ${moment(pickup_date).format("MMM D")}</small>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <i class="fas fas fa-exchange-alt fa-2x"></i>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <h5 class="mb-2">${drop_point[0].city.city_name}</h5>
                                        <p>${drop_point[0].point_name}</p>
                                        <small>${drop_point[0].pivot.time} at ${moment(drop_date).format("MMM D")}</small>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <div class="col-md-12 mb-2">
                            <h4>Total Price</h4>
                            <blockquote class="text-right">
                                <small>Ticket x${selected_seat.length}</small>
                                <h1>
                                    <b>IDR ${SET.__realCurrency(total)}</b>
                                </h1>
                            </blockquote>
                        </div>
                        <div class="col-md-12 mb-2">
                            <p>
                                <input type="hidden" name="route_id" id="route_id" value="${service.route.id}">
                                <input type="hidden" name="schedule_id" id="schedule_id" value="${service.id}">
                                <input type="hidden" name="departure_city" id="departure_city" value="${pickup_point[0].city.id}">
                                <input type="hidden" name="departure_point" id="departure_point" value="${pickup_point[0].id}">
                                <input type="hidden" name="departure_date" id="departure_date" value="${pickup_date}">
                                <input type="hidden" name="departure_time" id="departure_time" value="${pickup_point[0].pivot.time}">
                                <input type="hidden" name="arrival_city" id="arrival_city" value="${drop_point[0].city.id}">
                                <input type="hidden" name="arrival_point" id="arrival_point" value="${drop_point[0].id}">
                                <input type="hidden" name="arrival_date" id="arrival_date" value="${drop_date}">
                                <input type="hidden" name="arrival_time" id="arrival_time" value="${drop_point[0].pivot.time}">
                                <input type="hidden" name="total_price" id="total_price" value="${total}">
                                Dengan memilih Lanjut ke Pembayaran, Anda menyetujui Syarat & Ketentuan serta Kebijakan Privasi DIPASS Provider.
                            </p>
                        </div>
                    </div>
                </div>
            `

            $('#price_container').html(html)
        }
    }
})(SettingController)

const BookingController = ( (SET , UI) => {
    const selected_seat = [];

    const __submitSearch = TOKEN => {
        $('#form_search').validate({
            errorElement: "div",
            errorPlacement: function (error, element) {
                if (element.hasClass("select2")) {
                    let el = element.next();
                    error.addClass("invalid-feedback");
                    $(".select2-selection").addClass("is-invalid");
                    error.insertAfter(el);
                } else {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                }
            },
            rules: {
                departure: 'required',
                arrival: 'required',
                date: 'required'
            },
            submitHandler: form => {
                let departure = $('#departure').val().split('-')
                let arrival = $('#arrival').val().split('-')
                let date = $('#date').val()

                let data = {
                    departure_city: departure[0],
                    departure_point: departure[1],
                    arrival_city: arrival[0],
                    arrival_point: arrival[1],
                    date: date
                }

                $.ajax({
                    url: `${SET.__apiURL()}booking/search`,
                    type: "POST",
                    dataType: "JSON",
                    data: data,
                    beforeSend: xhr => {
                        SET.__buttonLoader("#btn_submit");
                    },
                    headers: {
                        Authorization: `Bearer ${TOKEN}`
                    },
                    success: res => {
                       if(res.results.length !== 0){
                            UI.__renderResults(res.results, data)
                       } else {
                            UI.__renderNoResults()
                       }
                    },
                    error: err => {
                        
                    },
                    complete: () => {
                        SET.__closeButtonLoader("#btn_submit");
                    }
                });

            }
        })
    }

    const __getService = (TOKEN, id, callback) => {
        $.ajax({
            url: `${SET.__apiURL()}booking/schedule/${id}`,
            type: "GET",
            dataType: "JSON",
            headers: {
                Authorization: `Bearer ${TOKEN}`
            },
            success: res => {
                callback(res.results)
            },
            error: err => {

            },
            complete: () => {
                SET.__closeGlobalLoader();
            }
        });
    }

    const __getLayout = (TOKEN, { id, pickup_point, drop_point }, callback) => {
        $.ajax({
            url: `${SET.__apiURL()}booking/layout/${id}/${pickup_point}/${drop_point}`,
            type: "GET",
            dataType: "JSON",
            beforeSend: () => {
                let loader = `
                    <div class="text-center">
                        <h4>Loading For Seat...</h4>
                    </div>
                `

                $('#seat_container').html(loader)
            },
            headers: {
                Authorization: `Bearer ${TOKEN}`
            },
            success: res => {
                callback(res.results)
            },
            error: err => {

            },
            complete: () => {
                SET.__closeGlobalLoader();
            }
        });
    }

    const __wizardInit = (TOKEN, service) => {
        let form = $("#form_order").show();

        $("#form_order").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Proccess To Payment"
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                if(currentIndex > newIndex){
                    return true
                }

                if(currentIndex === 1){
                    selected_seat.length = 0

                    $(".check-seat:checked").each(function () {
                        let obj = {
                            seat_number: $(this).val(),
                            price: $(this).data('price')
                        }

                        selected_seat.push(obj)
                    });

                    let selected_checkbox = $('.check-seat:checked').length

                    if(selected_checkbox <= 0) {
                        toastr.warning('Please select at least 1 seat', 'Failed', SET.__bottomRightNotif())
                        return false
                    }

                    if (selected_checkbox > 4) {
                        toastr.warning('Max selected seat is 4', 'Failed', SET.__bottomRightNotif())
                        return false
                    }

                    return true
                }

                if(currentIndex === 2){
                    if(form.valid()){
                        $('.passenger_name').each(function(){
                            let myVal = $(this).val();
                            let index = $(this).data('index');

                            selected_seat[index] = { ...selected_seat[index], passenger_name: myVal }
                        })

                        $('.passenger_age').each(function(){
                            let myVal = $(this).val();
                            let index = $(this).data('index');

                            selected_seat[index] = { ...selected_seat[index], passenger_age: myVal }
                        })

                        $('.passenger_nik').each(function(){
                            let myVal = $(this).val();
                            let index = $(this).data('index');

                            selected_seat[index] = { ...selected_seat[index], passenger_nik: myVal }
                        })

                        $('.passenger_gender').each(function(){
                            let myVal = $(this).val();
                            let index = $(this).data('index');

                            selected_seat[index] = { ...selected_seat[index], passenger_gender: myVal }
                        })
                    }
                }

                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, newIndex) {
                let points = {
                    pickup_point: $('.pickup-check:checked').val(),
                    drop_point: $('.drop-check:checked').val()
                }

                if(currentIndex === 1){
                    if(service.route.bus.layout !== null){
                        __getLayout(TOKEN, { ...points, id: service.id }, seatMap => {
                            UI.__renderLayout(service, seatMap, selected_seat, points)
                        })
                    } else {
                        UI.__renderWithoutLayout()
                    }
                }
                
                if(currentIndex === 2){
                    UI.__renderPassengerForm(selected_seat)
                }

                if(currentIndex === 3){
                    UI.__renderConfirmPrice(selected_seat, points, service)
                }
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                $.ajax({
                    url: `${SET.__apiURL()}booking/order`,
                    type: "POST",
                    data: $('#form_order').serialize(),
                    dataType: "JSON",
                    beforeSend: () => {
                        console.log('Loading...')
                    },
                    headers: {
                        Authorization: `Bearer ${TOKEN}`
                    },
                    success: res => {
                        window.location.href = `${SET.__baseURL()}notification?message=${res.message}&redirect=booking/payment/${res.results.id}`;
                    },
                    error: err => {
                        console.log(err.responseJSON)
                    },
                    complete: () => {
                        SET.__closeGlobalLoader();
                    }
                });
            }
        })
        .validate({
            ignore: "input[type=hidden]",
            errorClass: "is-invalid",
            errorElement: "div",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            rules: {
                pickup_point: 'required',
                drop_point: 'required'
            }
        })
    }

    return {
        init: TOKEN => {

            SET.__closeGlobalLoader();

            $("#departure , #arrival").select2({
                ajax: {
                    url: `${SET.__apiURL()}booking/city_point`,
                    dataType: "JSON",
                    type: "GET",
                    headers: {
                        Authorization: `Bearer ${TOKEN}`
                    },
                    data: function (params) {
                        let query = {
                            search: params.term,
                        };

                        return query;
                    },
                    processResults: function (res) {
                        let filtered = [];

                        if(res.results.city.length !== 0){
                            let group = {
                                text: "Kota", 
                                children: []
                            }

                            res.results.city.map(v => {
                                let city = {
                                    id: v.id,
                                    text: `${v.city_name} (All Location)`,
                                    city_id: v.id
                                };

                                group.children.push(city);
                            });

                            filtered.push(group);
                        }
                        
                        if(res.results.point.length !== 0){
                            let group = {
                                text: "Terminal or Point",
                                children: []
                            }

                            res.results.point.map(v => {
                                let point = {
                                    id: `${v.city.id}-${v.id}`,
                                    text: `${v.point_name}, ${v.city.city_name}`,
                                    point_id: v.id,
                                    city_id: v.city.id
                                };

                                group.children.push(point);
                            });

                            filtered.push(group);
                        }

                        return {
                            results: filtered,
                        };
                    },
                    cache: true
                }
            });

            $("#date").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                startDate: new Date(), 
                format: 'dd-mm-yyyy', 
                orientation: 'bottom',
                maxViewMode: 0,
            });

            __submitSearch(TOKEN)

        },

        order: (TOKEN, param) => {
            __getService(TOKEN, param.id, data => {
                let master_pickup, master_drop
                
                if (param.pickup === null && param.departure !== null) {
                    master_pickup = data.route.points.filter(x => x.city.id === param.departure && x.pivot.pickup_point === 1);
                } else if(param.pickup !== null && param.departure !== null) {
                    master_pickup = data.route.points.filter(x => x.id === param.pickup && x.pivot.pickup_point === 1);
                } else if (param.pickup !== null && param.departure === null) {
                    master_pickup = data.route.points.filter(x => x.id === param.pickup && x.pivot.pickup_point === 1);
                } else {
                    master_pickup = data.route.points.filter(x => x.pivot.pickup_point === 1);
                }

                if (param.drop === null && param.arrival !== null){
                    master_drop = data.route.points.filter(x => x.city.id === param.arrival && x.pivot.drop_point === 1);
                } else if (param.drop !== null && param.arrival !== null) {
                    master_drop = data.route.points.filter(x => x.id === param.drop && x.pivot.drop_point === 1);
                } else if(param.drop !== null && param.arrival === null) {
                    master_drop = data.route.points.filter(x => x.id === param.drop && x.pivot.drop_point === 1);
                } else {
                    master_drop = data.route.points.filter(x => x.pivot.drop_point === 1);
                }

                let pickup_point = master_pickup.map((v, index) => {
                    return `
                        <div class="custom-control custom-radio">
                            <input type="radio" id="pickup_${index}" ${param.pickup === v.id ? 'checked' : ''} name="pickup_point" class="custom-control-input pickup-check" value="${v.id}">
                            <label class="custom-control-label" for="pickup_${index}"">${v.point_name}, ${v.city.city_name}</label>
                        </div>
                    `
                }).join('')

                let drop_point = master_drop.map((v, index) => {
                    return `
                        <div class="custom-control custom-radio">
                            <input type="radio" id="drop_${index}" ${param.drop === v.id ? 'checked' : ''} name="drop_point" class="custom-control-input drop-check" value="${v.id}">
                            <label class="custom-control-label" for="drop_${index}">${v.point_name}, ${v.city.city_name}</label>
                        </div>
                    `
                }).join('')

                $('#route_title').text(data.route.title)
                $('#bus_name').text(data.route.bus.bus_name)

                $('#pickup_container').html(pickup_point)
                $('#drop_container').html(drop_point)

                __wizardInit(TOKEN, data)
            })
        }
    }
})(SettingController , BookingUI)