<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .barcode-container {
        display: flex;
        justify-content: center;
        /* Center the barcode horizontally */
        align-items: center;
        width: 100%;
        /* Ensure it fits within the parent container */
        overflow: hidden;
        /* Prevent the content from overflowing */
    }

    .barcode-wrapper {
        max-width: 300px;
        /* Set the maximum width for the barcode */
        width: 100%;
        /* Adjusts to the parent width */
    }

    .barcode-wrapper img {
        width: 100%;
        /* Make the barcode fit within the container */
        height: auto;
        /* Maintain the aspect ratio */
    }
</style>

<body style="overflow-x: hidden;">
    <div id="print-div" class="main"
        style="width: 800px;background-image: url('{{ asset('assets/images/IMG-20240715-WA0032.jpeg') }}');    background-repeat: no-repeat;
    background-size: contain; height: 1000px; display: block; position: relative">
        <div class="A" style="position:relative;left: 0;top: 0;">
            <div class="DISTICT" style="position: relative; left: 25px;top: 17px;">
                {{ $record['retailBillPrintingComplete']['towN_NAME'] }}
            </div>
            <div class="Duplicate" style="position: relative;left: 150px;top: 0px;">
                Duplicate Bill
            </div>
            <div class="bill_type" style="position: relative;left: 580px;top: -2px;">
                Monthly Bill
            </div>
            <div class="top_number" style="position: relative;left: 130px;top: 32px;font-size: 12px; width:300px;">
                <div class="barcode-wrapper barcode-container">
                    <div class="barcode-wrapper">
                        {!! DNS1D::getBarcodeHTML($record['retailBillPrintingComplete']['baR_CODE'], 'C128', 2, 30) !!}
                    </div>
                </div>
            </div>
            <div class="consumer_number" style="position: relative;left: 125px;top: 75px;font-size: 12px;">
                {{ $record['retailBillPrintingComplete']['conS_NO'] }} </div>
            <div class="name" style="position: absolute;left: 25px;top: 165px;width: 310px;font-size: 12px;">
                {{ $record['retailBillPrintingComplete']['consumeR_NAME'] }} <br />
                {{ $record['retailBillPrintingComplete']['adD1'] }} <br />
                {{ $record['retailBillPrintingComplete']['adD2'] }}
            </div>
            <table class="plot_address"
                style="position: absolute;left: -10px;top: 235px;height: 22px;width: 332px;  table-layout: fixed;font-size: 12px;">
                <tbody>
                    <tr>
                        <td style=" width: 33%; font-size: font-size: 12px; text-align: center;">
                            {{ $record['retailBillPrintingComplete']['ploT_SIZE'] }}
                        </td>
                        <td style=" width: 33%; font-size: font-size: 12px; text-align: center;">
                            {{ $record['retailBillPrintingComplete']['additionaL_STORY'] }}
                        </td>
                        <td style=" width: 33%; font-size: font-size: 12px; text-align: center;">
                            {{ $record['retailBillPrintingComplete']['flaT_SIZE'] }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="billing_month"
                style="position: absolute;left: 19px;top: 278px;width: 331px; font-size: 12px;">
                <tbody>

                    @for ($i = 12; $i > 0; --$i)
                        <tr style="height: 16px">
                            <td style="width: 25%">{{ $record['retailBillPrintingComplete']['billinG_MONTH_' . $i] }}
                            </td>
                            <td style="width: 25%">{{ $record['retailBillPrintingComplete']['amounT_BILLED_' . $i] }}
                            </td>
                            <td style="width: 25%">{{ $record['retailBillPrintingComplete']['amounT_PAID_' . $i] }}
                            </td>
                            <td style="width: 25%">{{ $record['retailBillPrintingComplete']['paymenT_DATE_' . $i] }}
                            </td>
                        </tr>
                    @endfor


                </tbody>
            </table>

            <table class="billing_month"
                style="position: absolute;left: 320px;top: 480px;width: 438px;font-size: 12px; text-align: left; padding-right: 5px">
                <tbody>



                    <!--                --><?php // for ($i = 0; $i < 3; $i = $i + 1 ) {
                    ?>
                    <!---->
                    <tr style="height: 10px">
                        <td>{{ $record['retailBillPrintingComplete']['outstandinG_MSG_1'] }}</td>
                        <td>{{ $record['retailBillPrintingComplete']['outstandinG_MSG_2'] }}
                            {{ $record['retailBillPrintingComplete']['wateR_ARREARS'] }} </td>
                        <td>{{ $record['retailBillPrintingComplete']['outstandinG_MSG_3'] }}
                            {{ $record['retailBillPrintingComplete']['seweragE_ARREARS'] }}</td>

                    </tr>
                    <tr style="height: 10px">
                        <td>{{ $record['retailBillPrintingComplete']['outstandinG_MSG_4'] }}
                            {{ $record['retailBillPrintingComplete']['conservancY_ARREARS'] }}</td>
                        <td>{{ $record['retailBillPrintingComplete']['outstandinG_MSG_5'] }}
                            {{ $record['retailBillPrintingComplete']['firE_ARREARS'] }}</td>
                        <td>{{ $record['retailBillPrintingComplete']['outstandinG_MSG_6'] }}
                            {{ $record['retailBillPrintingComplete']['outstandinG_ARREARS'] }}</td>
                    </tr>
                    <!---->
                    <!--                --><?php //}
                    ?>


                </tbody>
            </table>
            <div class="name" style="position: absolute;font-size: 12px;left: 25px;top: 710px;width: 312px;">
                {{ $record['retailBillPrintingComplete']['consumeR_NAME'] }} <br />
                {{ $record['retailBillPrintingComplete']['adD1'] }} <br />
                {{ $record['retailBillPrintingComplete']['adD2'] }}
            </div>


        </div>

        <div class="B">
            <table class="da_te" style="position: absolute;left: 58%;bottom: 84%; width: 280px;font-size: 12px;">
                <tbody>
                    <tr>
                        <td style="padding-right:0px;">
                            {{ $record['retailBillPrintingComplete']['bilL_PERIOD'] }}
                        </td>
                        <td style="padding-right: 0px;">
                            {{ $record['retailBillPrintingComplete']['issU_DT'] }}
                        </td>
                        <td>
                            {{ $record['retailBillPrintingComplete']['duE_DT'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="town_code" style="position: absolute;left: 41%;bottom: 69%;font-size: 13px;">
                <tbody>
                    <tr>
                        <td>
                            {{ $record['retailBillPrintingComplete']['towN_CODE'] }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Water</td>
                    </tr>
                    <tr>
                        <td>Sewerage</td>
                    </tr>
                    <tr>
                        <td>Convencery</td>
                    </tr>
                    <td>Fire</td>
                    <tr>
                        <td>Bank Charges</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Surcharge</td>
                    </tr>
                </tbody>
            </table>
            <table class="water_charges_box"
                style="position: absolute;left: 390px;top: 185px;width: 300px;height: 142px;font-size: 10px">
                <tbody>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['wateR_CURRENT'] }}</td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['wateR_ARREAR'] }} </td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['totaL_WATER'] }} </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['seweragE_CURRENT'] }}</td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['sewwragE_ARREAR'] }} </td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['totaL_SEWERAGE'] }} </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['conservancY_CURRENT'] }}</td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['conservancY_ARREAR'] }} </td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['totaL_CONSERVANCY'] }} </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['firE_CURRENT'] }}</td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['firE_ARREAR'] }} </td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['totaL_FIRE'] }} </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">A</td>
                        <td style="width: 33.33%; text-align: right">B</td>
                        <td style="width: 33.33%; text-align: right">C </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['payablE_DUE_DATE'] }}</td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['payablE_DUE_DATE'] }}</td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['payablE_AFTER_DATE'] }}</td>
                    </tr>
                </tbody>

            </table>

        </div>

        <div class="C">
            <div class="consumer_number" style="position: relative;left: 183px;top: 578px;width: 152px;">
                {{ $record['retailBillPrintingComplete']['conS_NO'] }} </div>
            <table class="da_te" style="position: absolute;left: 57%;bottom:29.5%;font-size: 12px;">
                <tbody>

                    <tr>
                        <td style="padding-right: 65px;"> {{ $record['retailBillPrintingComplete']['wateR_CURRENT'] }}
                        </td>
                        <td style="padding-right: 54px;"> {{ $record['retailBillPrintingComplete']['wateR_ARREAR'] }}
                        </td>
                        <td> {{ $record['retailBillPrintingComplete']['totaL_WATER'] }} </td>
                    </tr>
                </tbody>
            </table>
            <table class="town_code" style="position: absolute;left: 40%;bottom: 17.8%;font-size: 14px;">
                <tbody>
                    <tr>
                        <td>
                            TOWN CODE
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Water</td>
                    </tr>
                    <tr>
                        <td>Sewerage</td>
                    </tr>
                    <tr>
                        <td>Convencery</td>
                    </tr>
                    <td>Fire</td>
                    <tr>
                        <td>Bank Charges</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SurCharge</td>
                    </tr>
                </tbody>
            </table>
            <table class="water_charges_box"
                style="position: absolute;left: 370px;top: 725px;width: 300px;height: 142px;font-size: 10px; ">
                <tbody>

                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['seweragE_CURRENT'] }}</td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['sewwragE_ARREAR'] }} </td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['totaL_SEWERAGE'] }} </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['conservancY_CURRENT'] }}</td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['conservancY_ARREAR'] }} </td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['totaL_CONSERVANCY'] }} </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['firE_CURRENT'] }}</td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['firE_ARREAR'] }} </td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['totaL_FIRE'] }} </td>
                    </tr>

                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['payablE_DUE_DATE'] }}</td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right">A</td>
                        <td style="width: 33.33%; text-align: right">B</td>
                        <td style="width: 33.33%; text-align: right">C </td>
                    </tr>
                    <tr style="height: 16px">
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right"></td>
                        <td style="width: 33.33%; text-align: right">
                            {{ $record['retailBillPrintingComplete']['payablE_AFTER_DATE'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>

            </table>

            <div class="top_number" style="position: absolute;left: 430px;top: 840px;width: 150px;text-align: right;">
                {{ $record['retailBillPrintingComplete']['outstandinG_ARREARS'] }} </div>
            <div class="top_number barcode-container"
                style="position: absolute;left: 300px;top: 890px;width: 150px;text-align: right;">
                <div class="barcode-wrapper">
                    {!! DNS1D::getBarcodeHTML($record['retailBillPrintingComplete']['baR_CODE'], 'C128', 2, 40) !!}
                </div>
            </div>
        </div>

    </div>

</body>

</html>
