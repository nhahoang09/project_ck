<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <style>
        .title{
            text-align: center;
        }
        .content{
            margin-left: 15px;

        }
    </style>
</head>

<body>
    <div class="es-wrapper-color">
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" >
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">

                        {{-- table image shop --}}
                        <table cellpadding="0" cellspacing="0" ư class="es-header" align="center" style="background-color: #fef9ef; border-collapse: separate; border-width:1px 1px 0px 1px; border-style: solid; border-color: black;" width="600" bgcolor="#fef9ef">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="1735" align="center">
                                        <h2 >Thanks for your order</h2>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                         {{-- table info custommer --}}
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="1755" align="center">
                                        <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                            <tbody>
                                                <tr>
                                                    <td >
                                                        {{-- thông tin đơn --}}
                                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p20b esd-container-frame" width="300" align="left">
                                                                        <table style="background-color: #fef9ef; border-color: black; border-collapse: separate; border-width: 1px 0px 1px 1px; border-style: solid;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p10b es-p20r es-p20l" align="left">

                                                                                        <h4 class="title">Thông tin đơn hàng:</h4>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20b es-p20r es-p20l" align="left">
                                                                                        <p class="content">Mã đơn hàng: {{ $order->id }} </p>
                                                                                        <p class="content">Ngày tạo: {{ $order->created_at }}</p>
                                                                                        @if ($order->payment==1)
                                                                                            <p class="content">Hình thức thanh toán: COD</p>
                                                                                        @elseif($order->payment==0)
                                                                                         <p class="content">Hình thức thanh toán: ATM</p>
                                                                                        @endif

                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        {{-- thông tin khách --}}
                                                        <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="300" align="left">
                                                                        <table style="background-color: #fef9ef; border-collapse: separate; border-width:1px 1px 1px 0px; border-style: solid; border-color: black;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p10b es-p20r es-p20l" align="left">
                                                                                        <h4 class="title">Thông tin khách hàng:<br></h4>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20b es-p20r es-p20l" align="left">
                                                                                        <p class="content">Họ và tên:{{ $order->name }} </p>
                                                                                        <p class="content">Địa chỉ: {{ $order->address }}</p>
                                                                                        <p class="content">Số điện thoại: {{ $order->phone }}</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                         {{-- table order detail --}}
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="1755" align="center">
                                        <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                            <tbody>
                                                <tr>
                                                    <td >
                                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p20b esd-container-frame" width="600" align="left">
                                                                        <table style="background-color: #fef9ef; border-color: black; border-collapse: separate; border-width: 0px 1px 1px 1px; border-style: solid;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p10b es-p20r es-p20l" align="left">
                                                                                        <h4 class="title">CHI TIẾT ĐƠN HÀNG</h4>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20b es-p20r es-p20l" align="left">

                                                                                        <table  cellpadding="0" cellspacing="0">
                                                                                            <tr>
                                                                                                <td width="690px" valign="top">
                                                                                                    <table width="100%" style="text-align: center;border-color: black; border-collapse: separate; border-width: 1px 0px 0px 0px; border-style: solid;">
                                                                                                        <thead style=" padding= 10px">
                                                                                                          <tr>
                                                                                                                <th>#</th>
                                                                                                                <th>Hình ảnh</th>
                                                                                                                <th>Tên sản phẩm</th>
                                                                                                                <th>Số lượng</th>
                                                                                                                <th>Giá</th>
                                                                                                                <th>Thành tiền</th>
                                                                                                          </tr>
                                                                                                        </thead>
                                                                                                        <tbody style="border: solid black; border-collapse:collapse;">
                                                                                                            @php
                                                                                                                $total=0;
                                                                                                            @endphp
                                                                                                            @if (!empty($order_details))
                                                                                                                @foreach ($order_details as $key =>$order_detail )
                                                                                                                    <tr style="border: 1px solid black; border-collapse:collapse;">
                                                                                                                        <td>{{ $key+1 }}</td>
                                                                                                                        <td><img src="{{ $message->embed(public_path().'/'.$order_detail->thumbnail ) }}" alt=""  style="width: 100px;, height: 80px;"></td>
                                                                                                                        <td>{{ $order_detail->name }}</td>
                                                                                                                        <td>{{ $order_detail->quantity }}</td>
                                                                                                                        <td>
                                                                                                                        @if ($order_detail->discount==null)
                                                                                                                            {{ number_format($order_detail->price).' VNĐ'}}
                                                                                                                        @else
                                                                                                                        @php
                                                                                                                            $price=$order_detail->price*(100- $order_detail->discount)/100;
                                                                                                                        @endphp
                                                                                                                            {{ number_format($price). ' VNĐ' }}

                                                                                                                        @endif
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                        @if ($order_detail->discount==null)
                                                                                                                        @php
                                                                                                                            $money = $order_detail->price * $order_detail->quantity;
                                                                                                                        @endphp
                                                                                                                            {{ number_format($money) .' VNĐ' }}
                                                                                                                        @else
                                                                                                                            @php
                                                                                                                                $money=$price*$order_detail->quantity;
                                                                                                                            @endphp
                                                                                                                            {{ number_format($money). ' VNĐ' }}
                                                                                                                        @endif
                                                                                                                        </td>

                                                                                                                    </tr>
                                                                                                                    @php
                                                                                                                         $total+=$money;
                                                                                                                    @endphp

                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                        </tbody>

                                                                                                      </table>

                                                                                                      <table width="100%" style="text-align: center;border-color: black; border-collapse: separate; border-width: 1px 0px 0px 0px; border-style: solid;">
                                                                                                        <tfoot >
                                                                                                            <tr>
                                                                                                                <td><b>Tổng tiền: {{ number_format($total).' VNĐ' }}<b></td>
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>

                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
