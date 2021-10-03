import numbro from 'numbro';

export const useDate = () => {

    const format = (date) => {
        return new Intl.DateTimeFormat('en-US', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
        }).format(new Date(date));
    };

    return { format };
}

export const useNumber = () => {

    const format = (number, options) => {
        return numbro(number).format(options);
    };

    const toThousand = (number) => {
        return numbro(number).format({
            thousandSeparated: true,
        });
    };

    const toCurrency = (number) => {
        // numbro(number).formatCurrency({ mantissa: 2 });

        return numbro(number).format({
            thousandSeparated: true,
            mantissa: 2,
        })
    };

    const toAverage = (number) => {
        return numbro(number).format({
            average: true,
            mantissa: 2,
        })
    };

    const toOrdinal = (number) => {
        return numbro(number).format({
            output: 'ordinal'
        })
    };

    const toBytes = (number) => {
        return numbro(number).format({
            output: 'byte',
            base: 'binary'
        })
    };

    const toPercentages = (number) => {
        return numbro(number).format({
            output: "percent",
            mantissa: 4,
        })
    };

    return {
        format,
        toThousand,
        toCurrency,
        toAverage,
        toOrdinal,
        toBytes,
        toPercentages
    };
};
