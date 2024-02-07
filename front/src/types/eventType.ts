export interface EventTypeType {
  id: number;
  label: string;
}

export interface EventPlaceType {
  id: number;
  name: string;
  latitude: number;
  longitude: number;
  city: string;
  eventType: EventTypeType;
}

export interface  EventType  {
  id: number;
  name: string;
  details?: string;
  eventPlace?: EventPlaceType;
  startAt: Date;
  endAt: string;
}
