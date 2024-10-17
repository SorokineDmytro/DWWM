//---------------------Ajout de la colonne image á la table article
alter table article add image varchar(250) default 'aucune_image.jpg';

//---------------------------------View liste commandes
create or replace view listecommande as
select cde.id as id, numcommande, datecommande, numtiers, nomtiers, adressetiers, round(sum(quantite*prixunitaire), 2) as montant
from commande cde, tiers trs, lignecommande lc
where trs.id = cde.tiers_id and cde.id = lc.commande_id
group by cde.id, numcommande, datecommande, numtiers, nomtiers, adressetiers
order by id desc;

//----------------------------------Create table Message (chat)
create table message(
id serial primary key not null, 
auteur varchar(250), 
message text, 
reception timestamp default current_timestamp, 
lu boolean default false);
//-------------------------------------Rajoute de file dans le tableau message
alter table message add file varchar(250) default '';