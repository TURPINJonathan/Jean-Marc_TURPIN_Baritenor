import type DateType from '@types/datesType'

export function useDateUtils() {
  /**
   * Usage: Get the current date
   */
  function getCurrentDate(): Date {
    return new Date();
  }

  /**
   * Usage: Get the current month (by default) or other date with specific format (long by default)
   * @param date 
   * @param format 
   * @returns string
   */
  function getMonth(date: Date = getCurrentDate() as Date, format: DateType['formats'] = 'long'): string {
    const validFormats = ["numeric", "2-digit", "narrow", "short", "long"] as DateType['formats'][];

    if (!validFormats.includes(format)) {
      throw new Error("Format invalide pour le mois");
    }
    const options: Intl.DateTimeFormatOptions = {
			month: format as DateType,
		};
    return date.toLocaleDateString('fr-FR', options);
  }

  /**
   * Usage: Get the current year (by default) or other date with specific format (numeric by default)
   * @param date 
   * @param format 
   * @returns 
   */
  function getYear(date: Date = getCurrentDate() as Date, format: DateType['formats'] = 'numeric'): string {
    const validFormats = ["numeric", "2-digit", "narrow", "short", "long"] as DateType['formats'][];

    if (!validFormats.includes(format)) {
      throw new Error("Format invalide pour le mois");
    }
    const options: Intl.DateTimeFormatOptions = {
			year: format as DateType,
		};
    return date.toLocaleDateString('fr-FR', options);
  }

  function formatTime(dateTime: Date | string, hourFormat: DateType['timeFormats'] = '2-digit', minuteFormat: DateType['timeFormats'] = '2-digit', ): string {
    const options: Intl.DateTimeFormatOptions = {
        hour: hourFormat,
        minute: minuteFormat
    };

    if (typeof dateTime === 'string') {
        dateTime = new Date(dateTime);
    }

    return dateTime.toLocaleTimeString('fr-FR', options);
}

  function formatDate(date: Date|string, yearFormat: string = 'numeric', monthFormat: string = 'long', dayFormat: string = 'numeric', weekdayFormat: DateType = 'long') {
    const options: Intl.DateTimeFormatOptions = {
      year: yearFormat as DateType,
      month: monthFormat as DateType,
      day: dayFormat as DateType,
      weekday: weekdayFormat as DateType,
    };

    if (typeof date === 'string') {
      date = new Date(date)
    }
    
    return date.toLocaleDateString("fr-FR", options);
  }

  function isSameDay(dateFrom: Date, dateTo: Date) {
    if (!dateFrom || !dateTo) {
      return false;
    }

    if (typeof dateTo === 'string') {
      dateTo = new Date(dateTo);
    }

    if (typeof dateFrom === 'string') {
      dateFrom = new Date(dateFrom);
    }
    
    return (
      dateFrom.getDate() === dateTo.getDate() &&
      dateFrom.getMonth() === dateTo.getMonth() &&
      dateFrom.getFullYear() === dateTo.getFullYear()
    );
  };

  function isSameMonth(dateFrom: Date, dateTo: Date) {
    return (
      dateFrom.getMonth() === dateTo.getMonth() &&
      dateFrom.getFullYear() === dateTo.getFullYear()
    );
  };

  return {
    getCurrentDate,
    getMonth,
    getYear,
    formatDate,
    isSameDay,
    isSameMonth,
    formatTime
  };
}
