import type DateType from '@types/datesType'

export function useDateUtils() {
  /**
   * Usage: Get the current date
   */
  function getCurrentDate(): Date {
    return new Date();
    // Wed Feb 07 2024 20:58:59 GMT+0100 (heure normale d’Europe centrale)
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

  function formatDate(date: Date, yearFormat: string = 'numeric', monthFormat: string = 'long', dayFormat: string = 'numeric', weekdayFormat: DateType = 'long') {
    const options: Intl.DateTimeFormatOptions = {
      year: yearFormat as DateType,
      month: monthFormat as DateType,
      day: dayFormat as DateType,
      weekday: weekdayFormat as DateType,
    };
    return date.toLocaleDateString("fr-FR", options);
  }

  function isSameDay(date1: Date, date2: Date) {
    if (!date1 || !date2) {
      return false;
    }
    
    return (
      date1.getDate() === date2.getDate() &&
      date1.getMonth() === date2.getMonth() &&
      date1.getFullYear() === date2.getFullYear()
    );
  };

  function isSameMonth(date1: Date, date2: Date) {
    return (
      date1.getMonth() === date2.getMonth() &&
      date1.getFullYear() === date2.getFullYear()
    );
  };

  return {
    getCurrentDate,
    getMonth,
    getYear,
    formatDate,
    isSameDay,
    isSameMonth
  };
}
